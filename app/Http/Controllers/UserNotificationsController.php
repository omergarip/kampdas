<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNotificationsController extends Controller
{
    public function show($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
            return redirect(route('events.show', $notification->data['slug']));
        }
    }

    public function readNotification() {
        auth()->user()->update(['read_at' => now()]);
        return redirect()->back();
    }
}
