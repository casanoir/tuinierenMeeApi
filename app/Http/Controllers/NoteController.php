<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use DB;

class NoteController extends Controller
{
    public function showAllNotes()
    {
        return response()->json(Note::all());
    }

    public function showOneNote($id)
    {
        return response()->json(Note::find($id));
    }

    public function createNote(Request $request)
    {
        $note = Note::create($request->all());

        return response()->json($note, 201);
    }

    public function updateNote($id, Request $request)
    {
        $note = Note::findOrFail($id);
        $note->update($request->all());

        return response()->json($note, 200);
    }

    public function deleteNote($id)
    {
        Note::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    public function getUserNotes($id)
{
    $result = DB::select("SELECT SELECT users.id,users.firstName,users.lastName,users.roll,users.avatar,notes.subject,notes.priority,notes.text,notes.user_id FROM users JOIN notes ON users.id = notes.user_id WHERE notes.user_id= {$id}");
    return json_encode($result);
    
}
}
