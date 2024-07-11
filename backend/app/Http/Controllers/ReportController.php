<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function CreateReport(Request $request){
        $this->validate($request,[
            "prj_id"=>"required|exists:projects,id",
            "content"=>"required"
        ]);

        //Vérifier si un rapport existe déjà pour ce projet
        $existReport = Report::where('prj_id',$request->prj_id)->first();

        if ($existReport) {
            return response()->json([
                'message'=>'Un rapport existe déjà pour ce projet.'
            ], 400);
        }

        //créer un nouveau rapport
        $report = Report::create([
            'prj_id' => $request->prj_id,
            'content' => $request->content,
        ]);
        return response()->json([
            'report'=> $report
        ]);
    }
    public function AllReport(){
        $report = Report::orderBy();
    }
}
