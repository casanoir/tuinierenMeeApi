<?php

namespace App\Http\Controllers;

use App\Models\Garden;
use Illuminate\Http\Request;
use DB;

class GardenController extends Controller
{
// Show Garden
    public function showGarden()
    {
        $result=DB::select("SELECT gardens.id , gardens.name ,(gardens.length_cm*0.01 )*(gardens.width_cm*0.01) AS area_m°,gardens.city FROM gardens ");
        return json_encode($result);
    }
// Create Garden
    public function createGarden(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'length_cm' => 'required',
            'width_cm' => 'required',
            'country' => 'required',
            'city' => 'required',
            'street' => 'required'
        ]);
        $result =Garden::all()->first();
        if(!$result){
            $garden = Garden::create($request->all());
            return response()->json($garden, 201);
        }
        else{
            return 'i have already garden';
        }
        

        
    }
//Update garden
    public function updateGarden($id, Request $request)
    {
        $garden = Garden::findOrFail($id);
        $garden->update($request->all());

        return response()->json($garden, 200);
    }

    
}
