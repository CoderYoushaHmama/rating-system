<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //Notifications Page Function
    public function notificationsPage()
    {
        $user = Auth::guard('user')->user();
        $notifications = Notification::orderBy('created_at', 'asc')->get();
        return view('notifications.notifications', compact('user', 'notifications'));
    }

    //Delete Notification Function
    public function deleteNotification(Notification $notification)
    {
        $notification->delete();

        return redirect()->back()->with('success', 'rejected successfully');
    }
}
