<?php

namespace App\Logic\Product;

class InsertConditions
{
    public function isAmountUnlimited($input, $product){
        if($input->is_amount_unlimited){
            $product->is_amount_unlimited = 1;
        } else {
            $product->amount = $input->product_amount;
        }
    }

    public function isStartViewNow($input, $product){
        if($input->is_start_view_now){
            $product->start_at = time();
        } else {
            $f1 = explode('-', $input->start_at);
            $product->start_at = mktime(0, 0, 0, $f1[1], $f1[2], $f1[0]);
        }
    }

    public function expiresCondition($input, $product){
        if(isset($input->expires_condition)){
            switch($input->expires_condition){
                case "by_days":
                    $product->expires_at = time() + ($input->expires_days * 24 * 60 * 60);
                break;
                case "unlimited_expires":
                    $product->is_forever = 1;
                break;
            }  
        } else {
            $f2 = explode('-', $input->expires_at);
            $product->expires_at = mktime(0, 0, 0, $f2[1], $f2[2], $f2[0]);        
        }
    }
}