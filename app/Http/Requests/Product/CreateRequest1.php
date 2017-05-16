<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;

class CreateRequest1 extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $regex = "~^[A-Za-z0-9\(<->:.,%؟?)\s]{1,9999}$~iu";
        $regex2 = "~^[0-9,\s]{1,9999}$~iu";

        return [
            "product_name" => "required|min:5|max:255|regex:$regex",
            "product_description" => "required|min:5|regex:$regex",
            "serial_number" => "required|numeric|between:1,99999999999",

            "category_table_number" => "required|numeric|min:1",
            "category_id" => "required|numeric|min:1",

            "product_price" => "required|numeric|min:1",
            "price_discount" => "required|numeric|min:0|max:95",
            "product_amount" => "required_without:is_amount_unlimited|numeric|min:1",

            "is_start_view_now" => "boolean",
            "is_amount_unlimited" => "boolean",
            "expires_condition" => "string",

            "start_at" => "required_without:is_start_view_now|date|date_format:Y-m-d",
            "expires_at" => "required_without:expires_condition|date|date_format:Y-m-d",
            "expires_days" => "required_if:expires_condition,by_days|numeric|min:1|max:365"      
        ];
    }
}
