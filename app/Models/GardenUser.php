<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GardenUser extends Model
{
    protected $fillable = ['user_id','garden_id'];
}
