<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function CreateJob(Request $request){
        $this->validate($request,[
            "job_name"=>"required",
            "status"=>"required",
            "desc"=>"required",
        ]);
        $job = Job::create([
            "job_name"=>$request->job_name,
            "status"=>$request->status,
            "desc"=>$request->desc,
        ]);
        return response()->json([
            "job"=>$job
        ]);
    }
    public function AllJobs(){
        $job = Job::orderBy('id','desc')->paginate(9);
        $all = Job::orderBy('id','desc')->get();
        $jobN = Job::count();
        return response()->json([
            "jobs"=>$job,
            "jobN"=>$jobN,
            "all"=>$all
        ]);
    }
    public function GetJob($id){
        $job = Job::where('id',$id)->first();
        return response()->json([
            "job"=>$job
        ]);
    }
    public function UpdateJob(Request $request){
        $this->validate($request,[
            "job_name"=>"required",
            "status"=>"required",
            "desc"=>"required",
        ]);
        $job = Job::where('id',$request->id)->update([
            "job_name"=>$request->job_name,
            "status"=>$request->status,
            "desc"=>$request->desc,
        ]);
        return response()->json([
            "job"=>$job
        ]);
    }
    public function DeleteJob(Request $request){
        $job = Job::where('id',$request->id)->delete();
        return response()->json([
            "job"=>$job
        ]);
    }
}
