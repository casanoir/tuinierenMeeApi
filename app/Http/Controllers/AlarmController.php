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
//Create Alarm only for userID roles: baas or assistent or verantwortlijk or bezoeker
    public function createAlarm($userID,Request $request)
    {
        $user=User::findOrFail($userID);
        $usersroles=$user->roles;
        if($usersroles=="baas"){
            $this->validate($request, [
                'date' => 'required',
                'time' => 'required',
                'text'=> 'required',
                'user_id'=> 'required'
                ]); 
            $alarm = Alarm::create($request->all());
            return response()->json($alarm, 201);
            }
        else{
            return 'you don t have the ac';
            }
    }
//Update Alarm
    public function updateAlarm($id,$userID, Request $request)
    {
        $user=User::findOrFail($userID);
        $usersroles=$user->roles;
        if($usersroles!="bezoeker"){
            $alarm = Alarm::findOrFail($id);
            $alarm->update($request->all());
            return response()->json($alarm, 200);
            }
        else{
            return 'you don t have the ac';
            }
        
    }
//Delete alarm
    public function deleteAlarm($id,$userID)
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
