<?php

namespace App\Services;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\PricingRule;
use Carbon\Carbon;

class PricingService
{
    public function getPrice($productId, $quantity, $datetime = null)
    {
        $datetime = $datetime ?? now();

        $basePrice = Inventory::where('product_id', $productId)
            ->orderBy('created_at', 'desc')
            ->value('cost');

        $rule = PricingRule::where('product_id', $productId)
            ->where('start_at', '<=', $datetime)
            ->where('end_at', '>=', $datetime)
            ->orderBy('precedence', 'asc')
            ->first(); // assuming we have at most one type of pricing rule for each product (either time or quantity based) 

        $finalPrice = $basePrice;

        if ($rule) {
            if ($rule->type === 'time') {
                if ($this->checkTimeRule(json_decode($rule->conditions), $datetime)) {
                    $finalPrice = $this->applyDiscount($finalPrice, $rule);
                }
            } elseif ($rule->type === 'quantity') {
                if ($this->checkQuantityRule(json_decode($rule->conditions), $quantity)) {
                    $finalPrice = $this->applyDiscount($finalPrice, $rule);
                }
            }
        }

        return $finalPrice;
    }

    private function checkTimeRule($conditions, $datetime)
    {
        $currDay = $datetime->format('l');

        if (in_array($currDay, $conditions->days) && $datetime->format('H:i') >= $conditions->start_time && $datetime->format('H:i') <= $conditions->end_time) {
            return true;
        }

        return false;
    }

    private function checkQuantityRule($conditions, $quantity)
    {
        $min = $conditions->min_qty ?? null;
        $max = $conditions->max_qty ?? null;

        if (!is_null($min) && !is_null($max)) { // if rule has both min and max limit present
            return $quantity >= $min && $quantity <= $max;
        }

        if (!is_null($min)) {
            return $quantity >= $min;
        }

        if (!is_null($max)) {
            return $quantity <= $max;
        }

        // If neither condition is set, consider rule invalid
        return false;
    }

    protected function applyDiscount(float $price, PricingRule $rule): float
    {
        if ($rule->discount_type === 'percent') {
            return $price - ($price * $rule->discount / 100);
        } elseif ($rule->discount_type === 'fixed') {
            return $price - $rule->discount;
        }

        return $price;
    }
}
