<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function CreateTask(Request $request){
        $this->validate($request,[
            "task_name"=>"required",
            "prj_id"=>"required",
            "assignTo"=>"required",
            "startDate"=>"required",
            "endDate"=>"required",
            "progress"=>"",
            "status"=>"",
        ]);
        $tsk = Task::create([
            "task_name"=> $request->task_name,
            "prj_id"=> $request->prj_id,
            "assignTo"=> $request->assignTo,
            "startDate"=> $request->startDate,
            "endDate"=> $request->endDate,
            "progress"=> $request->progress,
            "status"=> $request->status,
        ]);
        return response()->json([
            "tsk"=>$tsk
        ]);
    }
    public function AllTask(){
        $tsks = Task::orderBy('id','desc')->paginate(9);
        $alls = Task::orderBy('id','desc')->get();
        $all = Task::count();
        return response()->json([
            "tsks"=>$tsks,
            "all"=>$all,
            "alls"=>$alls
        ]);
    }
    public function GetTask($id){
        $tsk = Task::where('id',$id)->first();
        return response()->json([
            "tsk"=>$tsk
        ]);
    }
    public function UpdateTask(Request $request){
        $this->validate($request,[
            "task_name"=>"required",
            "prj_id"=>"required",
            "assignTo"=>"required",
            "startDate"=>"required",
            "endDate"=>"required",
            "progress"=>"",
            "status"=>"",
        ]);
         $tsk = Task::Where('id',$request->id)->update([
            "task_name"=> $request->task_name,
            "prj_id"=> $request->prj_id,
            "assignTo"=> $request->assignTo,
            "startDate"=> $request->startDate,
            "endDate"=> $request->endDate,
            "progress"=> $request->progress,
            "status"=> $request->status,
        ]);
        return response()->json([
            "tsk"=>$tsk
        ]);
    }
    public function DeleteTask(Request $request){
        $tsk = Task::where('id',$request->id)->delete();
        return response()->json([
            "tsk"=>$tsk
        ]);
    }
}
