<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead(Request $request, $notificationId)
    {
        $notification = Auth::user()->notifications->find($notificationId);

        if ($notification && !$notification->read_at) {
            $notification->markAsRead();
        }

        return back();
    }

    public function remove(Request $request, $notificationId)
    {
        $notification = Auth::user()->notifications->find($notificationId);

        if ($notification) {
            $notification->delete();
        }

        return back();
    }

    public function all()
{
    $notifications = auth()->user()->notifications;
    return view('notifications.all', ['notifications' => $notifications]);
}
}

