<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Garden extends Model
{
    protected $fillable = ['name','length_cm','width_cm','country','city','street'];
}
