<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bill_detail extends Model
{
    protected $table='bill_details';
    
    protected $fillable = [
        'id' , 'id_bill' , 'id_product', 'quantity', 'price'
    ];

    public $timestamps = true;

    public function product(){
    	return $this->hasMany('app\product');
    }

    public function bill(){
    	return $this->belongTo('app\bill');
    }
}
