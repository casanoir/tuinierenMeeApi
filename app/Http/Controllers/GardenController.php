<?php

namespace App\Http\Controllers;

use App\Models\Garden;
use Illuminate\Http\Request;
use DB;

class GardenController extends Controller
{
    public function showGarden()
    {
        return response()->json(Garden::all());
    }

    public function createGarden(Request $request)
    {
        $garden = Garden::create($request->all());

        return response()->json($garden, 201);
    }

    public function updateGarden($id, Request $request)
    {
        $garden = Garden::findOrFail($id);
        $garden->update($request->all());

        return response()->json($garden, 200);
    }

    
}
