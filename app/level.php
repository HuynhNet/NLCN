<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class level extends Model
{
    protected $table='levels';
    
    protected $fillable = [
        'id' , 'level' , 'type_level',
    ];

    public $timestamps = true;
}
