<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Countries;
use Storage;

class SiteSettingRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $locale = config('app.locale');
        $currencies = json_decode(Storage::get("static_setting.json"))->currencies->$locale;

        return [
            'site_name' => 'required|min:3|max:20',
            'site_category' => 'required|min:3|max:50',
            'main_currency' => "required|min:0|max:" . count($currencies-1),
            'customer_service_number' => "required:string|min:10",
        ];
    }
}
