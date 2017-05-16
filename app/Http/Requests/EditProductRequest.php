<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditProductRequest extends Request
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
            //"category_id" => "required|numeric|min:0|max:$countries_count",
            "product_image_1" => "required_if:update_image_1,1|max:2048|mimes:png,jpg,jpeg",
            "product_image_2" => "max:2048|image|mimes:png,jpg,jpeg",
            "product_image_3" => "max:2048|image|mimes:png,jpg,jpeg",
            "product_price" => "required|numeric|min:1",
            "price_discount" => "required|numeric|min:0|max:95",
            "product_amount" => "required|numeric|min:1",
            //"product_carousel_image" => "max:4096|image|mimes:png,jpg,jpeg",
            //"start_at" => "required_without:start_view_now|date|date_format:Y-m-d",
            //"start_view_now" => "boolean",
            //"expires_at" => "required_without:expires_condition|date|date_format:Y-m-d",
            //"expires_condition" => "string",
            //"expires_days" => "required_if:expires_condition,by_days|numeric|min:1|max:365",
            //"product_tags" => "regex:$regex2",

            "amount_unlimited_status" => "boolean",
            //"is_product_carousel" => "required|boolean",
            //"is_carousel_live" => "required|boolean",
            //"new_status" => "required|boolean",
            //"live_status" => "required|boolean",
            "is_payment_on_delivery" => "required|boolean",
            "is_payment_by_paypal" => "required|boolean",
        ];
    }
}
