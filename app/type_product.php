<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class type_product extends Model
{
    protected $table='type_products';
    
    protected $fillable = [
        'id' , 'type_name' ,
    ];

    public $timestamps = true;

    public function products(){
    	return $this->hasMany('app\product');
    }
}
