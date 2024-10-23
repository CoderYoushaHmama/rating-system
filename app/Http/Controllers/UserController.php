<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //Get Users Page Function
    public function getUsersPage(Request $request)
    {
        $user = Auth::guard('user')->user();
        $users = User::where('full_name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('email', 'LIKE', '%' . $request->search . '%')->get();

        return view('users.users', compact('user', 'users'));
    }

    //Add User Page Function
    public function addUserPage()
    {
        return view('users.add_user');
    }

    //Edit User Page Function
    public function editUserPage(User $user)
    {
        return view('users.edit_user', compact('user'));
    }

    //Add User Function
    public function addUser(AddUserRequest $addUserRequest)
    {
        $user = User::create([
            'full_name' => $addUserRequest->full_name,
            'birth_date' => $addUserRequest->birth_date,
            'phone_number' => $addUserRequest->phone_number,
            'account_type' => $addUserRequest->account_type,
            'gender' => $addUserRequest->gender,
            'email' => $addUserRequest->email,
            'password' => Hash::make($addUserRequest->password),
        ]);

        if ($addUserRequest->file('image')) {
            $path = $addUserRequest->file('image')->storePublicly('usersImages', 'public');
            $user->update([
                'image' => 'storage/' . $path,
            ]);
        }

        Notification::create([
            'user_id' => $user->id,
            'description' => Auth::guard('user')->user()->full_name . ' added user ' . $user->full_name . ' to system',
            'type' => 'insert',
        ]);

        return redirect('/users')->with('success', 'user added successfully');
    }

    //Edit User Function
    public function editUser(User $user, EditUserRequest $editUserRequest)
    {
        $editUserRequest->validate([
            'email' => 'required|unique:users,email,' . $user->id,
        ]);
        if ($editUserRequest->password) {
            $editUserRequest->validated([
                'password' => 'min:8'
            ]);

            $user->update([
                'password' => Hash::make($editUserRequest->password),
            ]);
        }

        $user->update([
            'full_name' => $editUserRequest->full_name,
            'birth_date' => $editUserRequest->birth_date,
            'phone_number' => $editUserRequest->phone_number,
            'gender' => $editUserRequest->gender,
        ]);

        if ($editUserRequest->file('image')) {
            if (File::exists($user->iamge)) {
                File::delete($user->image);
            }
            $path = $editUserRequest->file('image')->storePublicly('usersImages', 'public');
            $user->update([
                'image' => 'storage/' . $path,
            ]);
        }

        Notification::create([
            'user_id' => $user->id,
            'description' => Auth::guard('user')->user()->full_name . ' updated user ' . $user->full_name,
            'type' => 'update',
        ]);

        return redirect('/users')->with('success', 'user updated successfully');
    }

    //Delete User Function
    public function deleteUser(User $user)
    {
        if (File::exists($user->image)) {
            File::delete($user->image);
        }
        Notification::create([
            'user_id' => $user->id,
            'description' => Auth::guard('user')->user()->full_name . ' deleted user ' . $user->full_name . ' from system',
            'type' => 'delete',
        ]);
        $user->delete();
        return redirect('/users')->with('success', 'user deleted successfully');
    }
}
