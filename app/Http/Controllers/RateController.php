<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Models\Notification;
use App\Models\Service;
use App\Models\UserRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    //Rating Function
    public function rating(RatingRequest $ratingRequest, Service $service)
    {
        $user = Auth::guard('user')->user();
        $rate = $service->rates()->where('user_id', $user->id)->first();
        if (!$rate) {
            UserRate::create([
                'user_id' => $user->id,
                'service_id' => $service->id,
                'stars' => $ratingRequest->stars,
                'comment' => $ratingRequest->comment,
            ]);
            Notification::create([
                'user_id' => $user->id,
                'description' => $user->full_name . ' rates service: ' . $service->service_name,
                'type' => 'insert',
            ]);
        } else {
            $rate->update([
                'stars' => $ratingRequest->stars,
                'comment' => $ratingRequest->comment,
            ]);
            Notification::create([
                'user_id' => $user->id,
                'description' => $user->full_name . ' rates service: ' . $service->service_name,
                'type' => 'update',
            ]);
        }

        return redirect()->back();
    }

    //Delete Rate Function
    public function deleteRate(UserRate $rate)
    {
        $notification = Notification::where('rate_id', $rate->id)->first();
        $user = Auth::guard('user')->user();
        if ($user->account_type == 'service provider') {
            return redirect()->back()->with('success', 'already sent to admin');
        }
        if ($user->account_type == 'admin') {
            if ($notification) {
                $rate->delete();
                $notification->delete();
            } else {
                $rate->delete();
            }
            return redirect()->back()->with('success', 'this rate deleted successfully');
        } else if ($user->account_type == 'service provider') {
            Notification::create([
                'user_id' => $user->id,
                'rate_id' => $rate->id,
                'description' => 'Delete Rate From Service:' . $rate->service->service_name,
                'type' => 'notify',
            ]);

            return redirect()->back()->with('success', 'waiting accept from admin');
        }
    }
}
