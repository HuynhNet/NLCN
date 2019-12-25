<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
    protected $table='bills';
    
    protected $fillable = [
        'id' , 'date-order' , 'total', 'payment', 'id_customer'
    ];

    public $timestamps = true;

    public function billDetail(){
    	return $this->hasMany('app\bill_detail');
    }

    public function customer(){
    	return $this->belongTo('app\customer');
    }
}
