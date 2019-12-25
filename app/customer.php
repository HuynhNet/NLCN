<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $table='customers';
    
    protected $fillable = [
        'id', 'name', 'email', 'address', 'phone',
    ];

    public $timestamps = true;

    public function bill(){
    	return $this->hasMany('app\bills');
    }
}
