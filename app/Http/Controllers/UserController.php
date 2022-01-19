<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    
    public function showAllUsers()
    {
        return response()->json(User::all());
        
    }

    public function createUsers(Request $request)
    {
        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    public function updateUsers($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json($user, 200);
    }

    public function deleteUsers($id)
    {
        User::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
//loginD-->Show User Email & Password
    
    // public function getUserLogin()
    // {
    //     // $result = DB::select("SELECT users.id ,users.email , users.password FROM users ");
    //     // return json_encode($result);
    //     $result = DB::select("SELECT users.id , users.password FROM users WHERE users.email LIKE 'test@test.com' ");
    //     return json_encode($result);
    // }

    public function getUserLogin(Request $request)
    {
        $this->validate($request, ['email' => 'required|email|unique:users']);
        
        $result = DB::select("SELECT users.id , users.password FROM users WHERE users.email = '$request' ");
        return json_encode($result);
    }

//userD-->Show User "firstName", "lastName", "avatar", "roll" where users.id = {$id}
    public function showUser($id)
    {
        $result = DB::select("SELECT users.firstName , users.lastName, users.avatar ,users.rolls FROM users WHERE users.id = {$id}");
        return json_encode($result);
    }

}
