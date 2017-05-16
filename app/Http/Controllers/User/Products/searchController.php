<?php

namespace App\Http\Controllers\User\Products;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Logic\Product\ProductRepository;
use App\Logic\Product\FilteringMethods;

use App\Models\Product\Product;
use App\Models\Product\Tag;

use Hashids\Hashids;
use Auth;
use DB;

class searchController extends Controller
{
    public function __construct(ProductRepository $ProductRepository, FilteringMethods $FilteringMethods){
        $this->productRepository = $ProductRepository;
        $this->filteringMethods = $FilteringMethods;
    } 

    public function getIndex(Request $request)
    {
        $inputs = (object) $request->all();

        $session = $this->filteringMethods->byName($inputs);
        $session = $this->filteringMethods->byPrices($inputs);
        $session = $this->filteringMethods->bySalesRange($inputs, .15, .70);
        $session = $this->filteringMethods->byCategory($inputs);

        $products = Product::users_roles()->conditions(
            $session['where_conditions'],
            $session['where_in_conditions'],
            $session['where_between_conditions']
        )->paginate(3);
        
        $this->productRepository->optimizeIndexProductContoller($products);

        return view("front.$this->frontendNumber.product.search.view")
            ->with("products", $products)
            ->with("searchParameters", $session['parameters']);
    }

    public function byCategoryName($category_code, $category_name)
    {
        $hashids = new Hashids('', 2, '0123456789ABCDEF');
        $category_code = $hashids->decode($category_code);
        $category_table_number = $category_code[0];
        $category_id = $category_code[1];

        $products = Product::users_roles()->nested_categories($category_table_number, $category_id)->paginate(20);

        $productRepository = new ProductRepository;
        $products = $productRepository->optimizeIndexProductContoller($products);

        return view("front.$this->frontendNumber.product.view")->with(compact(
            'products'
        ));
    }

    public function getTag($tag_name)
    {
        $tag_id = Tag::where("tag_name", $tag_name)->value('id');
        
        if(!is_numeric($tag_id)) abort(404);

        $tag = Tag::find($tag_id);
        $products = $tag->products()->users_roles()->paginate(10);
            
        return view("front.$this->frontendNumber.product.view")
            ->with("products", $products)
            ->with("title1", "Product about <b>".$tag_name."</b> tag");
    }
}
