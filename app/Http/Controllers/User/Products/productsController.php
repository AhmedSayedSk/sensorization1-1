<?php

namespace App\Http\Controllers\User\Products;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Logic\Product\ProductRepository;

use App\Models\Product\Product;
use App\Models\Product\Image;

use Auth;
use Response;
use Event;
use Cart;
use DB;

class productsController extends Controller {

    protected function checkPage($paginate_number)
    {
        $paginate_count = ceil(Product::users_roles()->count() / $paginate_number);

        if(isset($_GET['page']) && $_GET['page'] > $paginate_count){
            return abort(404);
        }
    }

    public function getAll()
    {
        $paginate_number = 10;
        $this->checkPage($paginate_number);

        $products = Product::orderBy('id', 'DESC')->users_roles()->paginate($paginate_number);

        $productRepository = new ProductRepository;
        $products = $productRepository->optimizeIndexProductContoller($products);

        return view("front.$this->frontendNumber.product.view")->with(compact('products'));
    }

    public function getProductName($serial_number, $name = null)
    {
        $product = Product::users_roles()->where("serial_number", $serial_number)->first();
        if($product == null) abort(404);

        $productRepository = new ProductRepository;
        $product = $productRepository->optimizeShowProduct($product);

        Event::fire('products.view_counter', $product);

        if(count($product) == 0){
            return view('errors.product-not-founded');
        }

        $products_tags = $product->tags()->select("products_tags.tag_name")->lists('tag_name');

        return view("front.$this->frontendNumber.product.show")->with(compact(
            'product', 'products_tags'
        ));
    }
}
