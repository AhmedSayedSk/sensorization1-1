<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Countries;

class CategoryRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $regex = "~^[A-Za-z0-9\(-_.)\s]{1,9999}$~iu";

        return [
            'name' => "required|max:255|regex:$regex",
            'table_number' => "required|numeric|min:1",
            'related_id' => 'required_if:cat_table_num,2,3,4|numeric|min:0',
        ];
    }
}
