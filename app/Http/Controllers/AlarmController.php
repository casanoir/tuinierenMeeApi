<?php

namespace App\Http\Controllers;

use App\Models\Alarm;
use Illuminate\Http\Request;
use DB;

class AlarmController extends Controller
{
    public function showAllAlarms()
    {
        return response()->json(Alarm::all());
    }

    public function showOneAlarm($id)
    {
        return response()->json(Alarm::find($id));
    }

    public function createAlarm(Request $request)
    {
        $alarm = Alarm::create($request->all());

        return response()->json($alarm, 201);
    }

    public function updateAlarm($id, Request $request)
    {
        $alarm = Alarm::findOrFail($id);
        $alarm->update($request->all());

        return response()->json($alarm, 200);
    }

    public function deleteAlarm($id)
    {
        Alarm::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

//loginD-->Show User Email & Password
public function getUserAlarms($id)
{
    $result = DB::select("SELECT users.id,users.firstName,users.lastName,users.roll,users.avatar,alarms.date,alarms.time,alarms.text,alarms.user_id FROM users JOIN alarms ON users.id = alarms.user_id WHERE alarms.user_id= {$id}");
    return json_encode($result);
    
}

}
