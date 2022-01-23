<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class NoteController extends Controller
{
//Show Notes
    public function showAllNotes()
    {
        return response()->json(Note::all());
    }
//Show userNotes -->Show User's notes order by priority
    public function getUserNotes($id)
    {
        $result = DB::select("SELECT notes.id,notes.subject,notes.priority,notes.text,notes.user_id FROM users JOIN notes ON users.id = notes.user_id WHERE notes.user_id= {$id} ORDER BY priority ASC");
        return json_encode($result);
    }
//Create Note only for userID roles: baas or assistent or verantwortlijk or bezoeker
    public function createNote($userID,Request $request)
    {
        $user=User::findOrFail($userID);
        $usersroles=$user->roles;
        if($usersroles!="bezoeker"){
            $note = Note::create($request->all());
            return response()->json($note, 201);
        }
        else{
            return 'you don t have the ac';
            }
    }
//Update Note only for userID roles: baas or assistent or verantwortlijk or bezoeker
    public function updateNote($id,$userID, Request $request)
    {
        $user=User::findOrFail($userID);
        $usersroles=$user->roles;
        if($usersroles!="bezoeker"){
            $note = Note::findOrFail($id);
            $note->update($request->all());
            return response()->json($note, 200);
            }
        else{
            return 'you don t have the ac';
            }
        }
//Delete Note only for userID roles: baas or assistent or verantwortlijk or bezoeker
    public function deleteNote($id,$userID)
    {
        $user=User::findOrFail($userID);
        $usersroles=$user->roles;
        if($usersroles!="bezoeker"){
            Alarm::findOrFail($id)->delete();
            return response('Deleted Successfully', 200);
            }
        else{
            return 'you don t have the ac';
            }
        
    }
}
