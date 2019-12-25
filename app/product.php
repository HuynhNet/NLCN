<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table='products';
    
    protected $fillable = [
        'id' , 'name' , 'describe', 'price', 'promotion_price', 'image', 
        'id_type', 'firm', 'quantity'
    ];

    public $timestamps = true;

    public function typeProduct(){
    	return $this->belongTo('app\type_product');
    }

    public function billProduct(){
    	$this->belongTo('app\bill_detail');
    }
}
