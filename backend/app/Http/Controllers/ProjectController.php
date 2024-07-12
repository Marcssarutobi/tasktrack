<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function CreateProject(Request $request){
        $this->validate($request,[
            "name"=>"required",
            "assignTo"=>"required",
            "startDate"=>"required",
            "endDate"=>"required",
            "nbrTask"=>"",
            "progress"=>"",
            "status"=>"",
        ]);
        $prj = Project::create([
            "name"=>$request->name,
            "assignTo"=>$request->assignTo,
            "startDate"=>$request->startDate,
            "endDate"=>$request->endDate,
            "nbrTask"=>$request->nbrTask,
            "progress"=>$request->progress,
            "status"=>$request->status,
        ]);
        return response()->json([
            "prj"=>$prj
        ]);
    }
    public function AllProject(){
        $prj = Project::with('tasks')->orderBy('id','desc')->paginate(9);
        $all = Project::with('tasks')->orderBy('id','desc')->get();
        $count = Project::count();
        $countPrj = Project::with('tasks')->get();
        return response()->json([
            "prjs"=>$prj,
            "all"=>$all,
            "count"=>$count,
            "countprj" => $countPrj
        ]);
    }
    public function GetProject($id){
        $prj = Project::where('id',$id)->first();
        return response()->json([
            "prj"=>$prj
        ]);
    }
    public function UpdateProject(Request $request){
        $this->validate($request,[
            "name"=>"required",
            "assignTo"=>"required",
            "startDate"=>"required",
            "endDate"=>"required",
            "nbrTask"=>"required",
            "progress"=>"required",
            "status"=>"required",
        ]);
        $prj = Project::where('id',$request->id)->update([
            "name"=>$request->name,
            "assignTo"=>$request->assignTo,
            "startDate"=>$request->startDate,
            "endDate"=>$request->endDate,
            "nbrTask"=>$request->nbrTask,
            "progress"=>$request->progress,
            "status"=>$request->status,
        ]);
        return response()->json([
            "prj"=>$prj
        ]);
    }
    public function DeleteProject(Request $request){
        $prj = Project::where('id',$request->id)->delete();
        return response()->json([
            "prj"=>$prj
        ]);
    }
}
