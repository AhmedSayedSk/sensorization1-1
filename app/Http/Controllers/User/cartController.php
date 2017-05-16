<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Product\Image;

use Response;
use Auth;
use Cart;
use Config;

class cartController extends Controller
{
	public function __construct()
    {
		$this->middleware('auth');
        $this->frontendNumber = Config::get('setting.frontendNumber');
	}

    public function getIndex()
     {
        $cartCollection = Cart::getContent();
    	$total_items = json_decode($cartCollection->toJson());
        $total_price = 0;

        foreach ($total_items as $value) {
            $price = $value->price;
            $discount_percentage = $value->attributes->discount_percentage;
            $quantity = $value->quantity;
            $total_price += ($price - $price * ($discount_percentage/100)) * $quantity;
        }

		return view("front.$this->frontendNumber.user.cart.view")
            ->with("cart_total_items", $total_items)
            ->with("totalPrice", $total_price)
            ->with("itemsCount", $cartCollection->count());
    }

    protected function checkCurrentQuantity($productId, $productAmount, $inputQuantity){
        // check for direct value entered 
        if($inputQuantity > $productAmount){
            return false;
        }

        // check for cumulative value entered
        if(Cart::get($productId) != null){
            $current_cart_quantity = Cart::get($productId)->quantity;
            if(($current_cart_quantity + $inputQuantity) > $productAmount){
                return false;
            }
        }

        return true;
    }

    public function postAddItem(Request $request, $product_id)
    {
        $input = (object) $request->all();

        if(Auth::check()){
            $product = Product::users_roles()->find($product_id);
            $product_image = Image::where('parent_id', $product->id)->value("image_name");

            $state = $this->checkCurrentQuantity($product_id, $product->amount, $input->quantity);

            if(!$state) {
                return Response::json([
                    'error' => true,
                    'message' => trans('sub_validation.cart.max_quantity'),
                    'code' => 400
                ], 400);
            }

            Cart::add([
                'id' => $product_id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $input->quantity,
                'attributes' => [
                    'product_serial_number' => $product->serial_number,
                    'image_name' => $product_image,
                    'discountPrice' => $product->price - (($product->price * $product->discount_percentage) / 100),
                    'discount_percentage' => $product->discount_percentage,
                    'is_real' => $product->is_real
                ]
            ]);

            return Response::json([
                'error' => false,
                'message' => 'Product is add successfully',
                'code' => 200,
                'cart_count' => Cart::getContent()->count()
            ], 200);

        } else {
            return Response::json([
                'error' => true,
                'code' => 401
            ], 401);
        }
    }

    public function postRemoveItem($id)
    {
    	Cart::remove($id);
        return Response::json([
            'error' => false,
            'message' => 'Item was deleted successfully.',
            'code' => 200
        ], 200);
    }

    public function getClearCart()
    {
        Cart::clear();
        return back();
    }
}
