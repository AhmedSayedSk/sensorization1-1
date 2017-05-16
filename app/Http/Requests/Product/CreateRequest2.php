<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;
use Route;

class CreateRequest2 extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $regex = "~^[A-Za-z0-9\(<->:.,%؟?)\s]{1,9999}$~iu";
        $regex2 = "~^[0-9,\s]{1,9999}$~iu";

        //dd(Route::input('step_id'));

        return [
            //"product_carousel_image" => "max:4096|image|mimes:png,jpg,jpeg",
            "product_tags" => "regex:$regex2",

            "is_product_carousel" => "required|boolean",
            "is_carousel_live" => "required|boolean",
            "new_status" => "required|boolean",
            "live_status" => "required|boolean",
            "is_payment_on_delivery" => "required|boolean",
            "is_payment_by_paypal" => "required|boolean",
            "create_again" => "required|boolean",
        ];
    }
}
