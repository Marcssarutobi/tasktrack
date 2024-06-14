<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function CreateUser(Request $request){
        $this->validate($request,[
            "lastname"=>"required",
            "fistname"=>"required",
            "email"=>"required",
            "phone"=>"required",
            "password"=>"required",
            "job_id"=>"required",
            "role_id"=>"required",
        ]);

        $user = User::create([
            "lastname"=>$request->lastname,
            "fistname"=>$request->fistname,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "password"=>bcrypt($request->password),
            "job_id"=>$request->job_id,
            "role_id"=>$request->role_id,
        ]);
        return response()->json([
            "user"=>$user
        ]);
    }
    public function AllUser(){
        $user = User::orderBy('id','desc')->paginate(9);
        $userN = User::count();

        return response()->json([
            "users"=>$user,
            "userN"=>$userN
        ]);
    }
    public function GetUser($id){
        $user = User::where('id',$id)->first();
        return response()->json([
            "user"=>$user
        ]);
    }
    public function UpdateUser(Request $request){
        $this->validate($request,[
            "lastname"=>"required",
            "fistname"=>"required",
            "email"=>"required",
            "phone"=>"required",
            "job_id"=>"required",
            "role_id"=>"required",
        ]);
        $user = User::where('id',$request->id)->update([
            "lastname"=>$request->lastname,
            "fistname"=>$request->fistname,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "job_id"=>$request->job_id,
            "role_id"=>$request->role_id,
        ]);
        return response()->json([
            "user"=>$user
        ]);
    }
    public function DeleteUser(Request $request){
        $user = User::where('id',$request->id)->delete();
        return response()->json([
            "user"=>$user
        ]);
    }
    public function Login(Request $request){
       $user = $request->validate([
            "email"=>["required","email"],
            "password"=> "required"
       ]);
       $login = User::where("email", $user["email"])->first();
       if (Auth::attempt($user)) {
            $token = $login->createToken("CLE_SECRETE")->plainTextToken;
            return response()->json([
                "user"=>$login,
                "token"=>$token
            ]);
       }else{
            return response()->json([
                "message"=> "Adresse email ou mot de passe incorrect"
            ],401);
       }
    }
    public function authUserVerify(){
        //Vérifier si l'utilisateur est connecté
        if (Auth::check()) {
            return response()->json([
                'connect' => true
            ]);
        }else{
            return response()->json([
                'connect' => false
            ]);
        }
    }
    public function CurrentUser(){
        $user = Auth::user();
        if ($user) {
            return response()->json([
                'user' => $user,
                'role' => $user->role
            ]);
        }
    }
    public function Logout(Request $request){
        $user = Auth::user();
        if ($user) {
            Auth::logout();
            $user->tokens->each(function($token){
                $token->delete();
            });
        }
        return response()->json([
            "message"=>"Deconnexion"
        ],200);
    }
}
