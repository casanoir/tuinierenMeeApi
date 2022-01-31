<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class NoteController extends Controller
{
/*************GET*************** */
    //Show Notes
        public function showAllNotes()
            {
                $result = DB::select("SELECT 
                    notes.id, 
                    notes.subject, 
                    notes.priority, 
                    notes.text, 
                    notes.created_at, 
                    users.firstName, 
                    users.lastName 
                FROM users 
                JOIN notes 
                ON users.id = notes.user_id");
                return json_encode($result);
            }
    //Show userNotes -->Show User's notes order by priority
        public function getUserNotesByPriority($id)
            {
                $result = DB::select("SELECT 
                    notes.id,
                    notes.subject,
                    notes.priority,
                    notes.text,
                    notes.created_at, 
                    users.firstName, 
                    users.lastName  
                FROM users 
                JOIN notes 
                ON users.id = notes.user_id 
                WHERE notes.user_id= {$id}
                ORDER BY priority ASC");

                return json_encode($result);
            }
    //Show userNotes -->Show User's notes order by date
        public function getUserNotesByDate($id)
            {
                $result = DB::select("SELECT 
                    notes.id,
                    notes.subject,
                    notes.priority,
                    notes.text,
                    notes.created_at, 
                    users.firstName, 
                    users.lastName 
                FROM users 
                JOIN notes 
                ON users.id = notes.user_id 
                WHERE notes.user_id= {$id}
                ORDER BY created_at DESC");

                return json_encode($result);
            }
/*************POST*************** */
    //Create Note 
        public function createNote(Request $request)
            {
                $note = Note::create($request->all());
            }
/*************PUT*************** */
    //Update Note 
        public function updateNote($id, Request $request)
            {
                $note = Note::findOrFail($id);
                $note->update($request->all());
                return response()->json($note, 200);
            }
/*************DELETE*************** */
    //Delete Note 
        public function deleteNote($id)
            {
                Note::findOrFail($id)->delete();
                return response('Deleted Successfully', 200);
            }
}
