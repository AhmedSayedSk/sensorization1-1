<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Countries;

class EditUserProfileDataRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $regex = "~^[A-Za-z0-9\(-_.)\s]{1,9999}$~iu";
        $countries_count = Countries::count();

        return [
            "name" => "required|min:5|max:255|regex:$regex",
            "country_id" => "required|numeric|min:1|max:$countries_count",
            "address" => "min:15|max:255|regex:$regex",
        ];
    }
}
