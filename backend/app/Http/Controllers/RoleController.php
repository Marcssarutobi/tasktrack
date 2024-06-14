<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function CreateRole(Request $request){
        $this->validate($request,[
            "role_name"=>"required"
        ]);
        $role = Role::create([
            "role_name"=>$request->role_name
        ]);
        return response()->json([
            "role"=>$role
        ]);
    }
    public function AllRole(){
        $role = Role::orderBy('id','desc')->get();
        return response()->json([
            "roles"=>$role
        ]);
    }
    public function GetRole($id){
        $role = Role::where('id',$id)->first();
        return response()->json([
            'role'=>$role
        ]);
    }
    public function UpdateRole(Request $request){
        $this->validate($request,[
            "role_name"=>"required"
        ]);

        $role = Role::where('id',$request->id)->update([
            "role_name"=>$request->role_name
        ]);
        return response()->json([
            'role'=>$role
        ]);
    }
    public function DeleteRole(Request $request){
        $role = Role::where('id',$request->id)->delete();
        return response()->json([
            "role"=>$role
        ]);
    }
}
