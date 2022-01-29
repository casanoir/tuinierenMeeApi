<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class GardenPlantsController extends Controller
{
   //Show plants 
    public function showAllPlants()
    {
        $result = DB::select("SELECT * FROM plants");
        return json_encode($result);
        
    }
}
