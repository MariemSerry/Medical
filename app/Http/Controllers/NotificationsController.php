<?php

namespace App\Http\Controllers;

use App\Notifications;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
   public function getNotifications(Request $request){
       $Type=$request->input('type');
       $ID=$request->input('id');
       $getNotifications=Notifications::getNotifications($Type,$ID);
       return response($getNotifications);
   }
}
