<?php

namespace App\Http\Controllers;

use App\Models\NotificationAgent;
use App\Models\NotificationUser;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        
    }

    public function userNotification(){
        $notifications = NotificationUser::all();
        return view('notifications.notifications')
       ->with('notifications', $notifications);
    }

    public function agentNotification(){
        $notifications = NotificationAgent::all();

        return view('notifications.notifications')
       ->with('notifications', $notifications);
    }
}
