<?php

namespace App\Logic\Product;

use App\Models\Product\Product;

use Request;
use Auth;
use DB;

class SearchFormat
{
    protected function clientStatus(){
        if(Request::segment(1) == 'admin'){
            return Product::select('*');
        } else {
            return Product::users_roles();
        }
    }

	public function price(){
        $condition = DB::raw('price - (discount_percentage/100) * price');
		$price = (object) [
            'min' => $this->clientStatus()->min($condition),
            'max' => $this->clientStatus()->max($condition)
        ];

        return $price;
	}

    public function sales($perc1, $perc2){
        $caller = $this->clientStatus();

        $max_sale = $this->clientStatus()->max('sales');
        $percentage1 = $max_sale - $max_sale * $perc1;
        $percentage2 = $max_sale - $max_sale * $perc2;

        $sales_method = [
            1 => [
                "title" => "top sales",
                "salesCount" => $this->clientStatus()->where('sales', ">=", $percentage1)->count()
            ], 
            2 => [
                "title" => "middle sales",
                "salesCount" => $this->clientStatus()->whereBetween('sales', [$percentage2, $percentage1])->count()
            ],
            3 => [
                "title" => "low sales",
                "salesCount" => $this->clientStatus()->where('sales', "<=", $percentage2)->count()
            ],
            4 => [
                "title" => "no sales",
                "salesCount" => $this->clientStatus()->where('sales', 0)->count()
            ]
        ];

        return $sales_method;
    }
}