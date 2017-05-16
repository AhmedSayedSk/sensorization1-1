<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RolesRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'create_products_ROLE' => "required|boolean",
            'edit_products_ROLE' => "required|boolean",
            'delete_products_ROLE' => "required|boolean",
            'products_live_status_ROLE' => "required|boolean",
            'products_carousel_controls_ROLE' => "required|boolean",
            'delete_users_ROLE' => "required|boolean",
            'carts_controls_ROLE' => "required|boolean",
            'tags_controls_ROLE' => "required|boolean",
        ];
    }
}
