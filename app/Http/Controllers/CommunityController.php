<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Community;
use DB;

class CommunityController extends Controller
{
/*************GET*************** */
    //  Show all community text -> "userNAme" "avatar" "text" "createAt"
        public function showAllPost()
        {
            $result = DB::select(" SELECT  
                communities.id,
                users.firstName, 
                users.lastName,
                users.avatar,
                communities.text,
                communities.created_at
            FROM communities 
            INNER JOIN users 
            ON users.id = communities.user_id
            ORDER BY created_at DESC");
            return json_encode($result);
        }
    //  Show my post -> "userNAme" "avatar" "text" "createAt"
        public function showPost($id)
                {
                    $result = DB::select(" SELECT  
                        communities.id,
                        users.firstName, 
                        users.lastName,
                        users.avatar,
                        communities.text,
                        communities.created_at
                    FROM communities 
                    INNER JOIN users 
                    ON users.id = communities.user_id
                    WHERE communities.user_id={$id}
                    ORDER BY created_at DESC");
                    return json_encode($result);
                }   
/*************POST*************** */
    //Create Alarm 
        public function createPost(Request $request)
        {
            $this->validate($request, [
                'user_id'=> 'required'
                ]); 
            $post = Community::create($request->all());
            return response()->json($post, 201);
        }
/*************PUT*************** */
    //Update user
        public function updatePost($id, Request $request)
            {
                $post = Community::findOrFail($id);
                $post->update($request->all());

                return response('Update Successfully', 200);
            }
/*************DELETE*************** */
    //Delete alarm
    public function deletePost($id)
    {
        Community::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }


}
