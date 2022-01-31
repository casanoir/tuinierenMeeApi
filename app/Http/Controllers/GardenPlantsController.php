<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GardenPlant;
use App\Models\Garden;
use App\Models\User;
use DB;


class GardenPlantsController extends Controller
{
/*************GET*************** */
    //Show all plants 
        public function showAllPlants()
        {
            $result = DB::select("SELECT  		
                plants.id,
                plants.image,
                plants.name,
                plants.suns_hday,
                plants.foliage_day,
                plants.fertilizer_day,
                plants.water_day,
                levels.name AS level,
                levels.description,
                frosts.name AS frost
            FROM plants 
            INNER JOIN levels 
            ON levels.id = plants.level_id
            INNER JOIN frosts
            ON frosts.id = plants.frost_id
            ORDER BY plants.name");
            return json_encode($result);
        }
    //Show plant Info 
        public function showPlantInfo($id)
        {
            $result = DB::select("SELECT
                plants.id,
                plants.image,
                plants.name,
                plants.harvest,
                plants.tip,
                plants.keep,
                plants.attention,
                plants.suns_hday,
                plants.foliage_day,
                plants.fertilizer_day,
                plants.water_day,
                plants.deepDistance_cm,
                plants.rowDistance_cm,
                plants.collumDistance_cm,
                levels.name AS level,
                levels.description,
                frosts.name AS frost,
                waterings.name AS watering
            FROM plants 
            INNER JOIN levels 
            ON levels.id = plants.level_id
            INNER JOIN frosts
            ON frosts.id = plants.frost_id
            INNER JOIN waterings
            ON waterings.id = plants.watering_id
            WHERE plants.id= {$id}");
            return json_encode($result);
        }
    //Search with plant's name
        public function searchPlant(Request $request)
        {
            $plantName=$request->name;
            $result = DB::select("SELECT
                plants.id, 		
                plants.image,
                plants.name,
                plants.suns_hday,
                plants.foliage_day,
                plants.fertilizer_day,
                plants.water_day,
                levels.name AS level,
                levels.description,
                frosts.name AS frost
            FROM plants 
            INNER JOIN levels 
            ON levels.id = plants.level_id
            INNER JOIN frosts
            ON frosts.id = plants.frost_id
            WHERE plants.name = '$plantName'");
            return json_encode($result);
        }
/*************POST*************** */
    //Add plant to the garden
        public function addPlantToGarden(Request $request)
        {

            $this->validate($request, [
                'plant_id' => 'required',
                'garden_id' => 'required'
                ]);    
            $gardenPlant = GardenPlant::create($request->all()); 
            return response('Add Successfully', 200);;
        }
/*************DELETE*************** */

    // Delete plant from my garden
        public function deleteGardenPlant($id,$userId)
        {
            $user=User::findOrFail($userId);
            $usersrole=$user->role;
            if($usersrole=="baas"){
                GardenPlant::findOrFail($id)->delete();
                return response('Deleted Successfully', 200);
                }
            else{
                return 'you don t have the ac';
                }
        }
    
}