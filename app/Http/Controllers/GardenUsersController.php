<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GardenUsersController extends Controller
{
    //
    //create gaden user
    // $userId = User::find(1)->id;
    // $gardenId = $garden->id;
    // $requestG->input ('user_id.' .$userId);
    // $requestG->input ('garden_id.' .$gardenId);
    // GardenUser::create($requestG->all());
    // echo $userId;
    // echo $gardenId;
    // show COUNT member
    public function amountUsers()
    {
        $result = DB::select("SELECT COUNT(garden_users.id) FROM garden_users");
        return json_encode($result);
        
    }
}
