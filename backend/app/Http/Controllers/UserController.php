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
        $all = User::orderBy('id','desc')->get();
        $userN = User::count();

        return response()->json([
            "users"=>$user,
            "userN"=>$userN,
            "alluser"=>$all
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
       $login = $request->validate([
            "email"=> ["required","email"],
            "password"=> ["required","string","min:3","max:30"]
        ]);

        //$user = User::where("email",$login["email"])->first();

        if (Auth::attempt($login)) {
            $user = Auth::user(); 
            $token = $user->createToken("CLE_SECRETE")->plainTextToken;
            return response()->json([
                "user" => $user,
                "token" => $token      
            ],200);
        }else{
            return response()->json([
                "message"=> "Adresse email ou mot de passe incorrect"
            ],401);
        }
    }
    public function authUserVerify(){
        // Vérifier si un utilisateur est connecté
        if (Auth::check()) {
        // L'utilisateur est connecté
        // Vous pouvez accéder à l'utilisateur authentifié via auth()->user()
        //$user = auth()->user();
        return response()->json([
            'connect' => true
        ]);
        // Faites ici ce que vous avez besoin de faire pour un utilisateur connecté
        } else {
        // L'utilisateur n'est pas connecté
        // Faites ici ce que vous avez besoin de faire pour un utilisateur non connecté
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
