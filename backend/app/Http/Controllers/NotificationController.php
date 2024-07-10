<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function CreateNotif(Request $request){

        $this->validate($request,[
            "user_id"=>"required",
            "subject"=>"required",
            "message"=>"required",
            "status"=>"",
        ]);

        $notif = Notification::create([
            "user_id" => $request->user_id,
            "subject" => $request->subject,
            "message" => $request->message,
            "status" => $request->status
        ]);

        return response()->json([
            "notif" => $notif
        ]);

    }
    public function AllNotif(){
        $notif = Notification::orderBy('id','desc')->get();
        $notifall = Notification::count();
        $notif_non_lue = Notification::where('status',true)->count();
        $notif4 = Notification::where('status',true)->orderBy('id','desc')->take(4)->get();

        return response()->json([
            "notifs"=>$notif,
            "notifC"=>$notifall,
            "notif_non_lue"=>$notif_non_lue,
            "notif4"=>$notif4
        ]);
    }
    public function GetNotif($id){
        $notif = Notification::where('id',$id)->first();
        return response()->json([
            "notif"=>$notif
        ]);
    }
    public function UpdateNotif(Request $request){
        $this->validate($request,[
            "user_id"=>"required",
            "subject"=>"required",
            "message"=>"required",
            "status"=>"",
        ]);
        $notif = Notification::where('id',$request->id)->update([
            "user_id" => $request->user_id,
            "subject" => $request->subject,
            "message" => $request->message,
            "status" => $request->status
        ]);
        return response()->json([
            "notif"=>$notif
        ]);
    }
    public function DeleteNotif(Request $request){
        $notif = Notification::where('id',$request->id)->delete();
        return response()->json([
            "notif"=>$notif
        ]);
    }
}
