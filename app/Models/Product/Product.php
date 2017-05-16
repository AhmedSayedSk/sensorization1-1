<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\Admin;
use Auth;
use DB;

class Product extends Model
{
    public static function rulesStep1($regex)
    {
        return [
            "product_name" => "required|min:5|max:255|regex:$regex",
            "product_description" => "required|min:5|regex:$regex",
            "serial_number" => "required|numeric|between:1,99999999999",

            "category_table_number" => "required|numeric|min:1",
            "category_id" => "required|numeric|min:1",

            "product_price" => "required|numeric|min:1",
            "discount_percentage" => "required|numeric|min:0|max:95",
            "product_amount" => "required_without:is_amount_unlimited|numeric|min:1",

            "is_start_view_now" => "boolean",
            "is_amount_unlimited" => "boolean",
            "expires_condition" => "string",

            "start_at" => "required_without:is_start_view_now|date|date_format:Y-m-d",
            "expires_at" => "required_without:expires_condition|date|date_format:Y-m-d",
            "expires_days" => "required_if:expires_condition,by_days|numeric|min:1|max:365"
        ];
    }

    public static function rulesStep2($regex)
    {
        return [
            "product_tags" => "regex:$regex",
            "is_carousel_live" => "required|boolean",
            "is_new" => "required|boolean",
            "is_live" => "required|boolean",
            "is_payment_on_delivery" => "required|boolean",
            "is_payment_by_paypal" => "required|boolean",
            'primary_image_id' => 'numeric|min:1',
            'primary_carousel_id' => 'numeric|min:1',
            "create_again" => "required|boolean"
        ];
    }

    public function tags() {
    	return $this->belongsToMany('App\Models\Product\Tag', 'products_tags_relationship', 'product_id', 'tag_id');
    }

    public function images() {
        return $this->hasMany('App\Models\Product\Image', 'parent_id', 'product_id');
    }

    public function scopeUsers_roles($query) {
        return $query->where([
            ['is_live', 1],
            ['start_at', "<=", time()],
            ['expires_at', ">=", time()]
        ]);
    }

    public function scopeProducts_carousel($query) {
    	$products_carousel = LiveCarousel::lists('product_id');
        return $query->whereIn("id", $products_carousel);
    }

    public function scopeConditions($query, $where_conditions, $whereIn_conditions, $whereBetween_conditions) {
        if($where_conditions != null){
            $query->where($where_conditions);
        }

        if($whereIn_conditions != null){
            for ($i = 0; $i < count($whereIn_conditions); $i++) {
                $query->whereIn($whereIn_conditions[$i][0], $whereIn_conditions[$i][1]);
            }
        }

        if($whereBetween_conditions != null){
            $data = $whereBetween_conditions;
            for ($i = 0; $i < count($data); $i++) { 
                $query->whereBetween($data[$i][0], [$data[$i][1][0], $data[$i][1][1]]);
            }
        }

        return $query;
    }

    public function scopeCategories_list($query, $cat_table_number, $cat_id){
        for ($i = $cat_table_number; $i >= 1; $i--) {
            if($i == $cat_table_number && $i > 1){
                $table_values = DB::table("products_categories_$i")->find($cat_id);
                $related_id = $table_values->related_id;
                $categories[] = $table_values->name;
            } else {
                if(!isset($related_id)) $related_id = $cat_id;
                $categories[] = DB::table("products_categories_$i")
                    ->find($related_id)->name;
            }    
        }
        return array_reverse($categories);
    }

    // complex system to get products by nested categories calling
    public function scopeNested_categories($query, $cat_table_number, $cat_id){

        switch($cat_table_number){
            case 1:
                $query
                    // Loop: 1
                    ->orWhere(function ($query) use ($cat_id) {
                        $query->orWhere([
                            'category_table_number' => 1,
                            'category_id' => $cat_id
                        ]);
                        
                        // Loop: 2
                        $query->orWhere(function ($query) use ($cat_id) {
                            $categories1 = \App\Models\Product\Category1::find($cat_id)->sub_cat->lists('id');

                            foreach($categories1 as $cat2_id) {
                                $query->orWhere([
                                    'category_table_number' => 2,
                                    'category_id' => $cat2_id
                                ]);

                                // Loop: 3
                                $query->orWhere(function ($query) use ($cat2_id) {
                                    $categories2 = \App\Models\Product\Category2::find($cat2_id)->sub_cat->lists('id');

                                    foreach($categories2 as $cat3_id) {
                                        $query->orWhere([
                                            'category_table_number' => 3,
                                            'category_id' => $cat3_id
                                        ]);

                                        // Loop 4
                                        $query->orWhere(function ($query) use ($cat3_id) {
                                            $categories3 = \App\Models\Product\Category3::find($cat3_id)->sub_cat->lists('id');
                                            
                                            foreach($categories3 as $cat4_id) {
                                                $query->orWhere([
                                                    'category_table_number' => 4,
                                                    'category_id' => $cat4_id
                                                ]);
                                            }
                                        });

                                    }
                                });
                            }
                        });
                    });
                return $query;
            break;
            case 2:
                $query
                    // Loop: 1
                    ->orWhere(function ($query) use ($cat_id) {
                        $query->orWhere([
                            'category_table_number' => 2,
                            'category_id' => $cat_id
                        ]);
                        
                        // Loop: 2
                        $query->orWhere(function ($query) use ($cat_id) {
                            $categories2 = \App\Models\Product\Category2::find($cat_id)->sub_cat->lists('id');

                            foreach($categories2 as $cat3_id) {
                                $query->orWhere([
                                    'category_table_number' => 3,
                                    'category_id' => $cat3_id
                                ]);

                                // Loop: 3
                                $query->orWhere(function ($query) use ($cat3_id) {
                                    $categories3 = \App\Models\Product\Category3::find($cat3_id)->sub_cat->lists('id');

                                    foreach($categories3 as $cat4_id) {
                                        $query->orWhere([
                                            'category_table_number' => 4,
                                            'category_id' => $cat4_id
                                        ]);
                                    }
                                });
                            }
                        });
                    });
                return $query;
            break;
            case 3:
                $query
                    // Loop: 1
                    ->orWhere(function ($query) use ($cat_id) {
                        $query->orWhere([
                            'category_table_number' => 3,
                            'category_id' => $cat_id
                        ]);
                        
                        // Loop: 2
                        $query->orWhere(function ($query) use ($cat_id) {
                            $categories3 = \App\Models\Product\Category3::find($cat_id)->sub_cat->lists('id');

                            foreach($categories3 as $cat4_id) {
                                $query->orWhere([
                                    'category_table_number' => 4,
                                    'category_id' => $cat4_id
                                ]);
                            }
                        });
                    });
                return $query;
            break;
            case 4:
                $query
                    // Loop: 1
                    ->orWhere(function ($query) use ($cat_id) {
                        $query->orWhere([
                            'category_table_number' => 4,
                            'category_id' => $cat_id
                        ]);
                    });
                return $query;
            break;
        } 
            
    }
}
