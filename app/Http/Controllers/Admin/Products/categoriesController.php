<?php

namespace App\Http\Controllers\Admin\Products;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;

use DB;
use Response;
use Carbon\Carbon;

class categoriesController extends Controller
{
    public function index(){

    	for ($i=1; $i <= 4; $i++) { 
    		$p_cats[] = DB::table("products_categories_$i")->get();
    	}

    	return view('back.products.categories.view')
    		->with("products_categories", $p_cats)
    		->with('p_cats', $p_cats);
    }

    public function create(){
        return view('back.products.categories.modals.create');
    }

    public function store(CategoryRequest $request){
    	$input = (object) $request->all();

        // validate category unique status
        $this->validate($request, [
            'name' => "unique:products_categories_".$input->table_number.",name",
        ]);

        $now = Carbon::now();

    	if($input->table_number == 1){
    		$p_cat_id = DB::table("products_categories_1")->insertGetId([
	    		"name" => $input->name,
                "created_at" => $now,
                "updated_at" => $now
	    	]);
    	} else {
    		$p_cat_id = DB::table("products_categories_".$input->table_number)->insertGetId([
	    		"name" => $input->name,
	    		"related_id" => $input->related_id,
                "created_at" => $now,
                "updated_at" => $now
	    	]);
    	}

    	return [
    		'id' => $p_cat_id,
            'name' => $input->name,
    		'table_number' => $input->table_number,
    		'related_id' => $input->related_id,
    	];
    }

    public function destroy(Request $request, $cat_table_num){
    	$cat_id = $request->input('cat_id');
    	$p_cat = DB::table("products_categories_".$cat_table_num)->where('id', $cat_id)->delete();
    	return back();
    }

    // used to get data by ajax request
    public function postGetDataByMethod1(Request $request){
        $product_cat_id = $request->input('p_cat_id');
        $cat_table_num = $request->input('table_num');

        $cat_list = DB::table("products_categories_".($cat_table_num + 1))
        	->where('related_id', $product_cat_id)
        	->lists('name', 'id');

        return [
        	 "cat_list" => $cat_list
        ];
    }
}
