<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{
    protected $fillable = ['date','time','text','user_id'];	
}
