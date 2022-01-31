<?php

namespace App\Http\Controllers;

use App\Models\Alarm;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class AlarmController extends Controller
{
/*************GET*************** */
    //Show all alarms order by date
        public function showAllAlarmsByDate()

        {
            $result = DB::select(" SELECT  
                alarms.id, 
                alarms.date, 
                alarms.task,
                users.firstName, 
                users.lastName,
                plants.name AS plant_name
            FROM alarms 
            INNER JOIN users 
            ON users.id = alarms.user_id
            INNER JOIN plants 
            ON plants.id = alarms.plant_id
            ORDER BY alarms.date DESC");
            return json_encode($result);
        }
    //Show all alarms order by task
        public function showAllAlarmsByTask()

        {
            $result = DB::select(" SELECT  
                alarms.id, 
                alarms.date, 
                alarms.task,
                users.firstName, 
                users.lastName,
                plants.name AS plant_name
            FROM alarms 
            INNER JOIN users 
            ON users.id = alarms.user_id
            INNER JOIN plants 
            ON plants.id = alarms.plant_id
            ORDER BY alarms.task DESC");
            return json_encode($result);
        }
    //Show all alarms order by plant
        public function showAllAlarmsByPlant()

        {
            $result = DB::select(" SELECT  
                alarms.id, 
                alarms.date, 
                alarms.task,
                users.firstName, 
                users.lastName,
                plants.name AS plant_name
            FROM alarms 
            INNER JOIN users 
            ON users.id = alarms.user_id
            INNER JOIN plants 
            ON plants.id = alarms.plant_id
            ORDER BY plant_name ASC");
            return json_encode($result);
        }
    //Show all alarms order by user
        public function showAllAlarmsByUsers()

        {
            $result = DB::select(" SELECT  
                alarms.id, 
                alarms.date, 
                alarms.task,
                users.firstName, 
                users.lastName,
                plants.name AS plant_name
            FROM alarms 
            INNER JOIN users 
            ON users.id = alarms.user_id
            INNER JOIN plants 
            ON plants.id = alarms.plant_id
            ORDER BY users.lastName ASC");
            return json_encode($result);
        }
    //Show User's alarms order by Date 
        public function getUserAlarmsByDate($id)
        {
            $result = DB::select("SELECT 	
                alarms.id, 
                alarms.date, 
                alarms.task,
                users.firstName, 
                users.lastName,
                plants.name AS plant_name
            FROM alarms 
            INNER JOIN users 
            ON users.id = alarms.user_id
            INNER JOIN plants 
            ON plants.id = alarms.plant_id
            WHERE alarms.user_id= {$id}
            ORDER BY alarms.date");
            return json_encode($result);
        }
    //Show User's alarms order by Task 
        public function getUserAlarmsByTask($id)
        {
            $result = DB::select("SELECT 	
                alarms.id, 
                alarms.date, 
                alarms.task,
                users.firstName, 
                users.lastName,
                plants.name AS plant_name
            FROM alarms 
            INNER JOIN users 
            ON users.id = alarms.user_id
            INNER JOIN plants 
            ON plants.id = alarms.plant_id
            WHERE alarms.user_id= {$id}
            ORDER BY alarms.task");
            return json_encode($result);
        }
    //Show User's alarms order by Plant 
        public function getUserAlarmsByPlant($id)
        {
            $result = DB::select("SELECT 	
                alarms.id, 
                alarms.date, 
                alarms.task,
                users.firstName, 
                users.lastName,
                plants.name AS plant_name
            FROM alarms 
            INNER JOIN users 
            ON users.id = alarms.user_id
            INNER JOIN plants 
            ON plants.id = alarms.plant_id
            WHERE alarms.user_id= {$id}
            ORDER BY plant_name");
            return json_encode($result);
        }

/*************POST*************** */
    //Create Alarm 
        public function createAlarm(Request $request)
        {
            $this->validate($request, [
                'date' => 'required',
                'task'=> 'required',
                'user_id'=> 'required',
                'plant_id'=> 'required'
                ]); 
            $alarm = Alarm::create($request->all());
            return response()->json($alarm, 201);
        }

/*************DELETE*************** */
    //Delete alarm
        public function deleteAlarm($id)
        {
            Alarm::findOrFail($id)->delete();
            return response('Deleted Successfully', 200);
        }
}
