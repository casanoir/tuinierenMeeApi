<?php

namespace App\Http\Controllers;

use App\Models\Alarm;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class AlarmController extends Controller
{
//Show alarms
    public function showAllAlarms()
    {
        return response()->json(Alarm::all());
    }
//UserAlarms id-->Show User's alarms order by date
    public function getUserAlarms($id)
    {
        $result = DB::select(" SELECT alarms.date,alarms.time,alarms.text FROM users JOIN alarms ON users.id = alarms.user_id WHERE alarms.user_id= {$id} ORDER BY date ASC");
        return json_encode($result);
    }
//Create Alarm 
    public function createAlarm(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'task'=> 'required',
            'user_id'=> 'required'
            ]); 
        $alarm = Alarm::create($request->all());
        return response()->json($alarm, 201);
    }
//Update Alarm
    public function updateAlarm($id,Request $request)
    {
        $alarm = Alarm::findOrFail($id);
        $alarm->update($request->all());
        return response()->json($alarm, 200);
    }
//Delete alarm
    public function deleteAlarm($id)
    {
        Alarm::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
