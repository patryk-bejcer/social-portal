<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//      Auth::user()->notifications->markAsRead();
        return view('notifications.index');
    }

    public function update($id)
    {

        DatabaseNotification::where([
            'id' => $id,
            'notifiable_id' => Auth::id()
        ])->firstOrFail()->markAsRead();

        return back();

    }



}
