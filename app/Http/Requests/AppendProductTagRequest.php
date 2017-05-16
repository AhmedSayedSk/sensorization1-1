<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AppendProductTagRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tag_name' => "required|unique:products_tags",
        ];
    }
}
