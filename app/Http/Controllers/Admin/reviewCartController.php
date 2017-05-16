<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CartItem;
use App\Models\Product\Product;

class reviewCartController extends Controller
{
    public function __construct(){
        $this->middleware('admin_function:carts_controls');
    }

    public function getPendingRequests(){
    	$cart_items = CartItem::where('is_accepted', 0)->updates_withPaginate(5);
    	return view("back.cart.pending-requests")->withCart_items($cart_items);
    }

    public function getAcceptedRequests(){
        $cart_items = CartItem::where('is_accepted', 1)->paginate(5);
        return view("back.cart.accepted-requests")
            ->withCart_items($cart_items);
    }

    public function store(Request $request){
        $input = (object) $request->all();

        $cart_item = CartItem::find($input->item_id);
        $cart_item->is_accepted = 1;
        $cart_item->accepted_at_timestamps = time();
        $cart_item->save();

        $product = Product::find($input->product_id)->decrement('amount', $input->needed_quantity);

        return back();
    }

    public function destroy($id){
    	CartItem::destroy($id);
    	return back();
    }
}
