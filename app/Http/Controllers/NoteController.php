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
//Create Note 
    public function createNote(Request $request)
    {
        $note = Note::create($request->all());
        return response()->json($note, 201);
    }
//Update Note 
    public function updateNote($id, Request $request)
    {
        $note = Note::findOrFail($id);
        $note->update($request->all());
        return response()->json($note, 200);
        }
//Delete Note 
    public function deleteNote($id)
    {
        Alarm::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
