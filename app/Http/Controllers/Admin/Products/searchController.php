<?php

namespace App\Http\Controllers\Admin\Products;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Logic\Product\ProductRepository;
use App\Logic\Product\FilteringMethods;

use App\Models\Product\Product;
use App\User;

class searchController extends Controller
{

    public function __construct(ProductRepository $ProductRepository, FilteringMethods $FilteringMethods){
        $this->productRepository = $ProductRepository;
        $this->filteringMethods = $FilteringMethods;
    } 

    public function getIndex(Request $request)
    {
        $inputs = (object) $request->all();

        $session = $this->filteringMethods->byIds($inputs);
        $session = $this->filteringMethods->byName($inputs);
        $session = $this->filteringMethods->byPrices($inputs);
        $session = $this->filteringMethods->bySalesRange($inputs, .15, .70);
        $session = $this->filteringMethods->byIsLive($inputs);
        $session = $this->filteringMethods->byIsDiscounted($inputs);

        $products = Product::conditions(
            $session['where_conditions'],
            $session['where_in_conditions'],
            $session['where_between_conditions']
        )->paginate(3);
        
        $this->productRepository->optimizeIndexProductContoller($products);

        return view("back.products.view")
            ->with("products", $products)
            ->with("searchParameters", $session['parameters']);
    }
}

