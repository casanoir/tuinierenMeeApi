<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Plants_gardens;
use App\Models\Garden;
use App\Models\User;
use DB;


class PlantsGardenController extends Controller
{
//Show all plants
    public function index()
    {
        $result = DB::select("SELECT * FROM `plants`");
        return json_encode($result);
        
    }
//Search with plant's name
    public function searchPlant(Request $request)
    {
        $plantName=$request->name;
        $result = DB::select("SELECT * FROM plants WHERE plants.name = '$plantName' ");
        return json_encode($result);
    }
//Add plant to the garden
    public function addPlantToGarden(Request $request)
    {
        $plantId=$request->plants_id;
        $count=json_encode(DB::select("SELECT COUNT(id) FROM plants_gardens"));
        echo $count;
        // $lenght=$count->COUNT;
        // if($lenght <= 6){
        //     $plant_garden = Plants_gardens::create($request->all());
        //     return response()->json($plant_garden, 201);
        // }else{
        //     return 'you dont have more place';
        // }
        $plant_garden = Plants_gardens::create($request->all());
        return response()->json($plant_garden, 201);
    }
//Show my plants 
    public function showMyplants()
    {
        $plants=json_encode(DB::select("SELECT plants_gardens.id, plants.name AS plantsName FROM plants JOIN plants_gardens ON plants.id =plants_gardens.plant_id "));
        return $plants;
    }
// Delete plant from my garden
    public function deletePlant($id,$userID)
    {
        $user=User::findOrFail($userID);
        $usersroles=$user->roles;
        if($usersroles!="bezoeker"){
            Plants_gardens::findOrFail($id)->delete();
            return response('Deleted Successfully', 200);
            }
        else{
            return 'you don t have the ac';
            }
    }
    
}
