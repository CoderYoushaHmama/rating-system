<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\RegisterMail;
use App\Mail\ResetPasswordMail;
use App\Models\Notification;
use App\Models\ResetPassword;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    //Login Page Function
    public function loginPage()
    {
        return view('authentication.login');
    }

    //Profile Page Function
    public function profile()
    {
        $user = Auth::guard('user')->user();
        return view('authentication.profile', compact('user'));
    }

    //Forgot Password Page Function
    public function forgotPasswordPage()
    {
        return view('authentication.forget_password');
    }

    //Reset Password Page Function
    public function resetPasswordPage()
    {
        return view('authentication.reset_password');
    }

    //Edit Password Page Function
    public function editPasswordPage()
    {
        return view('authentication.edit_password');
    }

    //Register Page Function
    public function registerPage()
    {
        return view('authentication.register');
    }

    //Activation Account Page Function
    public function activateAccountPage($email)
    {
        return view('authentication.activate_account', compact('email'));
    }

    //Login Function
    public function login(LoginRequest $loginRequest)
    {
        if (Auth::guard('user')->attempt(['email' => $loginRequest->email, 'password' => $loginRequest->password])) {
            $user = Auth::guard('user')->user();
            return redirect('/');
        }
        return redirect()->back()->with('error', 'incorrect email or password')->withInput();
    }

    //Logout Function
    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect('/login');
    }

    //Edit Profile Function
    public function editProfile(ProfileRequest $profileRequest)
    {
        $user = Auth::guard('user')->user();
        $user->update([
            'full_name' => $profileRequest->full_name,
            'birth_date' => $profileRequest->birth_date,
            'phone_number' => $profileRequest->phone_number,
            'gender' => $profileRequest->gender,
        ]);

        if ($profileRequest->file('image')) {
            if (File::exists($user->image)) {
                File::delete($user->image);
            }
            $path = $profileRequest->file('image')->storePublicly('usersImages', 'public');
            $user->update([
                'image' => 'storage/' . $path,
            ]);
        }

        Notification::create([
            'user_id' => $user->id,
            'description' => $user->full_name . ' updated his profile information',
            'type' => 'update',
        ]);

        return redirect()->back()->with('success', 'Your profile updated successfully');
    }

    //Forgot Password Function
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $verify = ResetPassword::create([
            'email' => $request->email,
            'code' => rand(1000, 9999),
            'created_at' => Carbon::now()->addMinutes(15),
        ]);

        try {
            Mail::to($request->email)->send(new ResetPasswordMail($verify->code));
        } catch (Exception $e) {
            $verify->delete();
        }
    }

    //Check Forgot Password Verification Function
    public function checkVerification(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        $verify = ResetPassword::where('email', $request->email)->latest()->first();
        if ($verify && $request->code == $verify->code && $verify->created_at > Carbon::now()) {
            $verify->delete();
            return response()->json([
                'success' => $request->email,
            ]);
        }
        return response()->json(['error' => 'incorrect verification code'], 405);
    }

    //Reset Password Function
    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $request->validate([
            'new_password' => 'required|min:8',
            'confirm_password' => 'required',
        ]);

        if ($request->new_password === $request->confirm_password) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            Notification::create([
                'user_id' => $user->id,
                'description' => $user->full_name . ' reset his password',
                'type' => 'update',
            ]);

            return redirect('/login');
        }
        return redirect()->back()->with('error', 'incorrect password confirmation');
    }

    //Edit Password Function
    public function editPassword(EditPasswordRequest $editPasswordRequest)
    {
        $user = Auth::guard('user')->user();
        if (Hash::check($editPasswordRequest->password, $user->password)) {
            if ($editPasswordRequest->new_password === $editPasswordRequest->confirm_password) {
                $user->update([
                    'password' => Hash::make($editPasswordRequest->new_password),
                ]);
                Notification::create([
                    'user_id' => $user->id,
                    'description' => $user->full_name . ' edited his password',
                    'type' => 'update',
                ]);
                return redirect('/')->with('success', 'your password updated successfully');
            }
            return redirect()->back()->with('error', 'incorrect password confirmation');
        }
        return redirect()->back()->with('error', 'incorrect password');
    }

    //Register Function
    public function register(RegisterRequest $registerRequest)
    {
        if ($registerRequest->password != $registerRequest->confirm_password) {
            return redirect()->back()->with('error', 'incorrect confirmation password')->withInput();
        }

        $verify = ResetPassword::create([
            'full_name' => $registerRequest->full_name,
            'birth_date' => $registerRequest->birth_date,
            'phone_number' => $registerRequest->phone_number,
            'gender' => $registerRequest->gender,
            'account_type' => $registerRequest->account_type,
            'email' => $registerRequest->email,
            'password' => Hash::make($registerRequest->password),
            'code' => rand(1000, 9999),
            'created_at' => Carbon::now()->addMinutes(15),
        ]);

        if ($registerRequest->file('image')) {
            $path = $registerRequest->file('image')->storePublicly('usersImages', 'public');
            $verify->update([
                'image' => 'storage/' . $path,
            ]);
        }

        try {
            Mail::to($registerRequest->email)->send(new RegisterMail($verify->code));
        } catch (Exception $e) {
            $verify->delete();
            return redirect()->back()->with('error', 'some thing went wrong')->withInput();
        }

        return redirect('/register/activation/' . $verify->email);
    }

    //Activation Account Function
    public function activateAccount(Request $request, $email)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $verify = ResetPassword::where('email', $email)->latest()->first();
        if ($verify && $request->code == $verify->code && $verify->created_at > Carbon::now()) {
            $user = User::create([
                'full_name' => $verify->full_name,
                'birth_date' => $verify->birth_date,
                'phone_number' => $verify->phone_number,
                'gender' => $verify->gender,
                'account_type' => $verify->account_type,
                'email' => $verify->email,
                'password' => $verify->password,
                'image' => $verify->image,
            ]);
            $verify->delete();

            Notification::create([
                'user_id' => $user->id,
                'description' => $user->full_name . ' registered in system',
                'type' => 'insert',
            ]);

            return redirect('/login');
        }

        return redirect()->back()->with('error', 'incorrect verification code');
    }
}