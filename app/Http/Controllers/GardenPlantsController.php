<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GardenPlant;
use App\Models\Garden;
use App\Models\User;
use DB;


class GardenPlantsController extends Controller
{
//Show all plants
    public function showAllPlants()
    {
        $result = DB::select("SELECT * FROM `plants`");
        return json_encode($result);
        
    }
//Search with plant's name
    public function searchPlant(Request $request)
    {
        $plantName=$request->name;
        $result = DB::select("SELECT * FROM plants WHERE plants.name LIKE '$plantName' ");
        return json_encode($result);
    }
//Add plant to the garden
    public function addPlantToGarden(Request $request)
    {

        $this->validate($request, [
            'plant_id' => 'required',
            'garden_id' => 'required'
            ]);    
        $gardenPlant = GardenPlant::create($request->all()); 
        return response()->json($gardenPlant, 201);
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
