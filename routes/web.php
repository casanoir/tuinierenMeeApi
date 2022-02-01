<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
/********************************************************************** */
                        //GET REQUEST
/********************************************************************** */
    // -----------Garden
        // Show garden:  id, name, area_m, city
            $router->get('garden',  ['uses' => 'GardenController@showGarden']);
    // -----------PlantsGarden
        // Get CHART    

        // Get from plantsGarden "foto" "name" "sun hour per day" "foliage days" "water days" "fertilizer days" "creatAt" "oorgst"
            
        // Show all plants -> "foto" "name" "sun hour per day" "foliage days" "water days" "fertilizer days" "levels" "frosts"
            $router->get('plants',  ['uses' => 'GardenPlantsController@showAllPlants']);
    // -----------Plants
        // Show all plants -> "foto" "name" "sun hour per day" "foliage days" "water days" "fertilizer days" "levels" "frosts"
            $router->get('plants',  ['uses' => 'GardenPlantsController@showAllPlants']);
        // Plant Info : all infos
            $router->get('plant/{id}',  ['uses' => 'GardenPlantsController@showPlantInfo']);
        // Search plants "name"  -> "foto" "name" "sun hour per day" "foliage days" "water days" "fertilizer days" "levels" "frosts" 
            $router->get('plant',  ['uses' => 'GardenPlantsController@searchPlant']);
        
    // -----------Notes
        // Show all notes 
            $router->get('notes',  ['uses' => 'NoteController@showAllNotes']);
        // Show notes -> "createAT" "createBy" "Subject" "priority" ORDER BY date
            $router->get('userNotesByDate/{id}',  ['uses' => 'NoteController@getUserNotesByDate']);
        // Show notes -> "createAT" "createBy" "Subject" "priority" ORDER BY priority
            $router->get('userNotesByPriority/{id}',  ['uses' => 'NoteController@getUserNotesByPriority']);
    // -----------Alarms
        // Show all alarms -> "date" "task" "plantName" "plantFoto" "userName" ORDER BY date
            $router->get('alarmsByDate',  ['uses' => 'AlarmController@showAllAlarmsByDate']);  
        // Show all alarms -> "date" "task" "plantName" "plantFoto" "userName" ORDER BY task
            $router->get('alarmsByTask',  ['uses' => 'AlarmController@showAllAlarmsByTask']);
        // Show all alarms -> "date" "task" "plantName" "plantFoto" "userName" ORDER BY plantName
            $router->get('alarmsByPlant',  ['uses' => 'AlarmController@showAllAlarmsByPlant']);
        // Show all alarms -> "date" "task" "plantName" "plantFoto" "userName" ORDER BY users
            $router->get('alarmsByUsers',  ['uses' => 'AlarmController@showAllAlarmsByUsers']);
        
        // Show user alarms -> "date" "task" "plantName" "plantFoto" "userName" ORDER BY date
        $router->get('getUserAlarmsByDate/{id}',  ['uses' => 'AlarmController@getUserAlarmsByDate']);  
        // Show user alarms -> "date" "task" "plantName" "plantFoto" "userName" ORDER BY task
            $router->get('getUserAlarmsByTask/{id}',  ['uses' => 'AlarmController@getUserAlarmsByTask']);
        // Show user alarms -> "date" "task" "plantName" "plantFoto" "userName" ORDER BY plantName
            $router->get('getUserAlarmsByPlant/{id}',  ['uses' => 'AlarmController@getUserAlarmsByPlant']);
    // -----------Communities
        //  Show all community text -> "userNAme" "avatar" "text" "createAt"
            $router->get('community',  ['uses' => 'CommunityController@showAllPost']);
        //  Show my post -> "userNAme" "avatar" "text" "createAt"
            $router->get('userPost/{id}',  ['uses' => 'CommunityController@showPost']);
    // -----------Users
        // Show users
            $router->get('user/{id}',  ['uses' => 'UserController@showUser']);
        // Email & Password Login
            $router->get('login',  ['uses' => 'UserController@getUserLogin']);
        // Show users name email phon avatar role createAt 
            $router->get('users',  ['uses' => 'UserController@showAllUsers']);
        // Get Amout users
            $router->get('amout',  ['uses' => 'UserController@amoutUsers']);
/********************************************************************** */
                        //POST REQUEST
/********************************************************************** */
    // -----------Garden
        //Create Garden
            $router->post('garden', ['uses' => 'GardenController@createGarden']);
    // -----------PlantsGarden
        // Add plant to garden -> "plantId" "gardenId"
            $router->post('addPlantToGarden', ['uses' => 'GardenPlantsController@addPlantToGarden']);
    // -----------Notes
        // Create Note -> "subject" "priority" "test" "userId"
            $router->post('note', ['uses' => 'NoteController@createNote']);
    // -----------Alarms
        // Create alarm ->"plantID" "userID" "date" "Task:'water', 'fertilizer', 'foliage'"
            $router->post('alarm', ['uses' => 'AlarmController@createAlarm']);
    // -----------Communities
        //Add post
            $router->post('post', ['uses' => 'CommunityController@createPost']);
    // -----------Users
        //New user request -> "firstName" "lastName" "email" "password" 
            $router->post('userRegister', ['uses' => 'UserController@register']);


/********************************************************************** */
                        //PUT REQUEST
/********************************************************************** */
    // -----------Garden
        //Update Garden
            $router->put('garden/{id}', ['uses' => 'GardenController@updateGarden']);
    // -----------Notes
        //Update Note userID roles
            $router->put('note/{id}', ['uses' => 'NoteController@updateNote']);
    // -----------Alarms
        //Update Alarm 
            $router->put('alarm/{id}', ['uses' => 'AlarmController@updateAlarm']);
    // -----------Users
        //Update user request+id
            $router->put('user/{id}', ['uses' => 'UserController@updateUser']);
    // -----------Community
        //Update POST request+id
            $router->put('post/{id}', ['uses' => 'CommunityController@updatePost']);

/********************************************************************** */
                        //DELETE REQUEST
/********************************************************************** */
    // -----------PlantsGarden
            $router->delete('plantsGarden/{id}/{userId}', ['uses' => 'GardenPlantsController@deleteGardenPlant']);
    // -----------Notes
            $router->delete('note/{id}', ['uses' => 'NoteController@deleteNote']);
    // -----------Alarms
            $router->delete('alarm/{id}', ['uses' => 'AlarmController@deleteAlarm']);
    // -----------Users
            $router->delete('user/{id}/{userID}', ['uses' => 'UserController@deleteUser']);
    // -----------Community
            $router->delete('post/{id}', ['uses' => 'CommunityController@deletePost']);

});




