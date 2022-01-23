<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
{
//Show users
    public function showAllUsers()
    {
        return response()->json(User::all());
        
    }

//Update user
    public function updateUser($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json($user, 200);
    }
//Delete user
    public function deleteUser($id,$num)
    {
        $user=User::findOrFail($num);
        $usersroles=$user->roles;
        if($usersroles=="baas" or $usersroles=="assistent"){
            User::findOrFail($id)->delete();
            return response('Deleted Successfully', 200);
            }
        else{
            return 'you don t have the ac';
            }
    }
    
//Register
    public function register(Request $request) 
    {
        $this->validate($request, [
        'firstName' => 'required',
        'lastName' => 'required',
        'email'=> 'required|email|unique:users',
        'password'=> 'required'
        ]);    
        $user = User::create($request->all());    
    }

//Login
    public function getUserLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $user = User::where('email', $request->input('email'))->first() ; 
        $userPw = User::where('password', $request->input('password'))->first() ;
        if($user){
            // echo 'email Ok';
            if($userPw){
                // echo 'pw Ok';
                $userEmail =  $request->email;
                $result = DB::select("SELECT users.id , users.firstName , users.lastName, users.avatar,users.phone_nummer, users.roles FROM users WHERE users.email = '$userEmail' ");
                return json_encode($result);
            }
            else{
                return 'pw Not ';
            }
        }
        else{
            return 'email Not ';
        }
        
    }
//Invitation
    public function invitation($userID,Request $request)
    {
    $user=User::findOrFail($userID);
    $usersroles=$user->roles;
    if($usersroles=="baas"){
        $this->validate($request, [
                'firstName' => 'required',
                'lastName' => 'required',
                'email'=> 'required|email|unique:users',
                'roles'=> 'required',
                'password'=> 'required'
                ]);    
            $user = User::create($request->all());
            return 'change the password after login';
        }
    else{
        return 'you don t have the ac';
        }
    }


}

