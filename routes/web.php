<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
//http://localhost:8000/api/garden

        // get request show garden:  id, name, area_m, city
    $router->get('garden',  ['uses' => 'GardenController@showGarden']);
        //Create Garden
    $router->post('garden', ['uses' => 'GardenController@createGarden']);
        //Update Garden
    $router->put('garden/{id}', ['uses' => 'GardenController@updateGarden']);

//http://localhost:8000/api/users

        // get request Show users
    $router->get('users',  ['uses' => 'UserController@showAllUsers']);
        // get request Show users
    $router->get('user/{id}',  ['uses' => 'UserController@showOneUser']);
        //get request Email & Password Login
    $router->get('login',  ['uses' => 'UserController@getUserLogin']);
        //POST new user request firstName lastName email password Register
    $router->post('userRegister', ['uses' => 'UserController@register']);
        //POST add user invitation request firstName lastName email password role:'assist','respond','view'
    $router->post('invitation/{userID}', ['uses' => 'UserController@invitation']);
        //Delete user id
    $router->delete('user/{id}/{userID}', ['uses' => 'UserController@deleteUser']);
        //Update user request+id
    $router->put('user/{id}', ['uses' => 'UserController@updateUser']);

//http://localhost:8000/api/alarms

        // get request Show alarms
    $router->get('alarms',  ['uses' => 'AlarmController@showAllAlarms']);
        // get request Show user's alarm 
    $router->get('userAlarms/{id}', ['uses' => 'AlarmController@getUserAlarms']);
        // Create alarm request
    $router->post('alarm', ['uses' => 'AlarmController@createAlarm']);
        //Delete alarm 
    $router->delete('alarm/{id}', ['uses' => 'AlarmController@deleteAlarm']);
        //Update Alarm 
    $router->put('alarm/{id}', ['uses' => 'AlarmController@updateAlarm']);

//http://localhost:8000/api/notes

        // get request Show notes
    $router->get('notes',  ['uses' => 'NoteController@showAllNotes']);
        // get request Show user notes
    $router->get('userNotes/{id}', ['uses' => 'NoteController@getUserNotes']);
        // Create Note request+userID
    $router->post('note', ['uses' => 'NoteController@createNote']);
        //Delete Note userID roles
    $router->delete('note/id', ['uses' => 'NoteController@deleteNote']);
        //Update Note userID roles
    $router->put('note/{id}', ['uses' => 'NoteController@updateNote']);
    
    
//http://localhost:8000/api/plants

        // Get request Show all plants
    $router->get('plants',  ['uses' => 'GardenPlantsController@showAllPlants']);
    //     // Get request "name" Search plants
    // $router->get('plant',  ['uses' => 'GardenPlantsController@searchPlant']);
    //     // POST request "name" Search plants
    // $router->post('plant',  ['uses' => 'GardenPlantsController@addPlantToGarden']);
    //     // Get all plants that i have in my garden -showMyplants($id)-
    // $router->get('plantsGarden',  ['uses' => 'GardenPlantsController@showMyplants']);
    //     // Delete plant from my garden 
    // $router->delete('deletePlant/{id}',  ['uses' => 'GardenPlantsController@deletePlant']);
});




