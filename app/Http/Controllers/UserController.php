<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
{
/*************GET*************** */
    //Login---> Password Hash & Auth
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
                    $result = DB::select("SELECT 
                        users.id , 
                        users.firstName , 
                        users.lastName, 
                        users.avatar, 
                        users.email, 
                        users.phone_nummer, 
                        users.role 
                    FROM users 
                    WHERE users.email = '$userEmail' ");
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

    //Show users 
        public function showAllUsers()
        {
            $result = DB::select("SELECT
                users.id , 
                users.firstName , 
                users.lastName, 
                users.email,
                users.avatar, 
                users.phone_nummer, 
                users.role 
            FROM
                users");
            return json_encode($result);
            
        }
    //Show user 
        public function showUser($id)
        {
            $result = DB::select("SELECT 
                users.id , 
                users.firstName , 
                users.lastName, 
                users.email,
                users.avatar,
                users.role,
                users.created_at
            FROM users 
            WHERE users.id = '$id'");
            return json_encode($result);
            
        }
    //GET Amout users
        public function amoutUsers()
        {
            $result = DB::select("SELECT 
                COUNT(users.id) AS amout 
                FROM users");
            return $result;
        }

/*************PUT*************** */
    //Update user
        public function updateUser($id, Request $request)
            {
                $user = User::findOrFail($id);
                $user->update($request->all());

                return response('Update Successfully', 200);
            }
/*************DELETE*************** */
    //Delete user
        public function deleteUser($id,$userID)
        {
            $user=User::findOrFail($userID);
            $usersrole=$user->role;
            
            if($usersrole=="baas"){
                User::findOrFail($id)->delete();
                return response('Deleted Successfully', 200);
                }
            else{
                return 'you don t have the ac';
                }
        }
    
/*************POST*************** */
    //Register---> Password Hash
        public function register(Request $request) 
        {
            {
                $this->validate($request, [
                'firstName' => 'required',
                'lastName' => 'required',
                'email'=> 'required|email|unique:users',
                'password'=> 'required'
                ]);    
                $user = User::create($request->all()); 
                $userId= $user->id;
            }
            $result = DB::select("SELECT 
                users.id , 
                users.firstName , 
                users.lastName, 
                users.avatar, 
                users.email, 
                users.phone_nummer,
                users.role 
            FROM users 
            WHERE users.id = '$userId' ");
            return json_encode($result);   
        }
    //Invitation---> Password Hash
        public function invitation($userID,Request $request)
        {
        $user=User::findOrFail($userID);
        $usersrole=$user->role;
        if($usersrole=="baas"){
            $this->validate($request, [
                    'firstName' => 'required',
                    'lastName' => 'required',
                    'email'=> 'required|email|unique:users',
                    'role'=> 'required',
                    'password'=> 'required'
                    ]);    
                    echo $request->role ;
                User::create($request->all());
                return 'change the password after login';
            }
        else{
            return 'you don t have the ac';
            }
        }


}

