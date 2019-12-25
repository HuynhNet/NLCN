<?php

namespace App\Imports;

use App\product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new product([
            'id_type' => $row[0],
            'name' => $row[1],
            'describe' => $row[2],
            'price' => $row[3],
            'promotion_price' => $row[4],
            'image' => $row[5],
            'quantity' => $row[6],
            'firm' => $row[7],
        ]);
    }
}
