<?php

namespace App\Logic\Product;

use App\Models\Product\Image;
use App\Models\Product\Product;

use Hashids\Hashids;
use DB;

class FilteringMethods
{
    protected $whereConditions;
    protected $whereInConditions;
    protected $whereBetweenConditions; 
    protected $searchParameters;

    protected function high_low($n1, $n2) {
        $n1 < $n2 ? $r = [$n1, $n2] : $r = [$n2, $n1];
        return $r;
    }

    protected function returnstatus(){
        return [
            'where_conditions' => $this->whereConditions, 
            'where_in_conditions' => $this->whereInConditions, 
            'where_between_conditions' => $this->whereBetweenConditions, 
            'parameters' => $this->searchParameters
        ];
    }

    public function byIds($inputs){
        if(isset($inputs->ids)) {
            $hashids = new Hashids('', 0, '13524796abogmtndlvt');
            $ids = $hashids->decode($inputs->ids);

            $this->whereInConditions[] = ["id", $ids];
            $this->searchParameters['ids'] = $inputs->ids;
        }

        return $this->returnstatus();
    }

	public function byName($inputs){
        if(isset($inputs->name)){
            $this->whereConditions[] = ['name', 'like', "%" . $inputs->name . "%"];
            $this->searchParameters['name'] = $inputs->name;
        }    

        return $this->returnstatus();
	}

    public function byPrices($inputs){
        if(isset($inputs->price1) && isset($inputs->price2)){
            $status = $this->high_low($inputs->price1, $inputs->price2);

            $this->whereConditions[] = [DB::raw('price - (discount_percentage/100) * price'), '>=', $status[0]];
            $this->whereConditions[] = [DB::raw('price - (discount_percentage/100) * price'), '<=', $status[1]];
            
            $this->searchParameters['price1'] = $inputs->price1;
            $this->searchParameters['price2'] = $inputs->price2;
        }

        return $this->returnstatus();
    }

    public function bySalesRange($inputs, $perc1, $perc2){
        if(isset($inputs->sales_range)){
            $max_sale = Product::max('sales');
            $percentage1 = $max_sale - $max_sale * $perc1;
            $percentage2 = $max_sale - $max_sale * $perc2;

            switch($inputs->sales_range){
                case 1:
                    $this->whereConditions[] = ['sales', '>=', $percentage1];
                break;
                case 2:
                    $this->whereBetweenConditions[] = ["sales", [$percentage2, $percentage1]];
                break;
                case 3:
                    $this->whereConditions[] = ["sales", '<=', $percentage2];
                break;
                case 4:
                    $this->whereConditions[] = ["sales", 0];
                break;
                default:
                    abort(404);
            }

            $this->searchParameters['sales_range'] = $inputs->sales_range;
        }

        return $this->returnstatus();
    }

    public function byCategory($inputs){
        if(isset($inputs->category) && $inputs->category != 0){
            $hashids = new Hashids('', 6, '0123456789CtNuoA');
            $this->whereConditions[] = ['category_table_number', $hashids->decode($inputs->category)];
            $this->searchParameters['category'] = $inputs->category;
        }

        return $this->returnstatus();
    }

    public function byIsLive($inputs){
        if(isset($inputs->isLive)){
            $this->whereConditions[] = ['is_live', $inputs->isLive];
            $this->searchParameters['isLive'] = $inputs->isLive;
        }

        return $this->returnstatus();
    }

    public function byIsDiscounted($inputs){
        if(isset($inputs->isDiscounted)){
            $this->whereConditions[] = ['discount_percentage', '>', 0];
            $this->searchParameters['isDiscounted'] = $inputs->isDiscounted;
        }

        return $this->returnstatus();
    }
}