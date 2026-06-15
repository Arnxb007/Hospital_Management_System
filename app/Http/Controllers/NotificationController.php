<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications =
            auth()->user()
            ->notifications()
            ->latest()
            ->get();

        return view(
            'notifications.index',
            compact('notifications')
        );
    }
    public function markAsRead($id)
    {
        $notification =
            auth()->user()
            ->notifications()
            ->findOrFail($id);

        $notification->update([
            'is_read' => true
        ]);

        return back();
    }
    public function open($id)
    {
        $notification = \App\Models\Notification::findOrFail($id);

        if($notification->user_id != auth()->id())
        {
            abort(403);
        }

        $notification->update([
            'is_read' => true
        ]);

        return redirect(
            $notification->link
             ?? '/notifications'
        );
    }
}
