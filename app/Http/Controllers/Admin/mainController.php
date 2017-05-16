<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Product\Product;

use Visitor;
use DB;

class mainController extends Controller
{
    public function getIndex(){
    	$products_count = Product::count();
    	$live_products_count = Product::where("is_live", 1)->count();
    	$products_carousel_count = Product::users_roles()->products_carousel()->count();
        $visitor_count = Visitor::count();
        $visitor_count_lastWeek = Visitor::range(date("d-m-Y", time() - 7 * 24 * 60 * 60), date("d-m-Y", time()));

        for ($i=1; $i <= 4; $i++) { 
            $products_categories[] = DB::table("products_categories_$i")->get();
        }

        return view("back.dashboard")->with(compact(
            'products_count', 'live_products_count', 'products_carousel_count',
            'products_categories', 'visitor_count', 'visitor_count_lastWeek'
        ));
    }
}
