<?php

namespace App\Services;

use App\Models\Coupon;

class CouponService
{
    public function applyCoupon($couponCode, $cartItems)
    {
        $coupon = Coupon::where('code', $couponCode)->first();

        if (!$coupon) {
            return ['success' => false, 'message' => 'Invalid coupon code'];
        }

        $totalPrice = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        $itemCount = $cartItems->sum('quantity');

        $rules = $coupon->rules;
        $discountConfig = $coupon->discounts;

        // Check coupon rules
        foreach ($rules as $rule) {
            switch ($rule['type']) {
                case 'min_cart_total':
                    if ($totalPrice < $rule['value']) {
                        return ['success' => false, 'message' => 'Coupon requirements not met.'];
                    }
                    break;
                case 'min_item_count':
                    if ($itemCount < $rule['value']) {
                        return ['success' => false, 'message' => 'Coupon requirements not met.'];
                    }
                    break;
            }
        }

        // Calculate the discount
        $discountAmount = 0;

        foreach ($discountConfig as $discount) {
            switch ($discount['type']) {
                case 'fixed':
                    $discountAmount += $discount['value'];
                    break;
                case 'percent':
                    $discountAmount += ($totalPrice * $discount['value'] / 100);
                    break;
                case 'mixed':
                    $fixedDiscount = $discount['fixed'] ?? 0;
                    $percentDiscount = ($totalPrice * ($discount['percent'] ?? 0) / 100);
                    $discountAmount += max($fixedDiscount, $percentDiscount);
                    break;
            }
        }

        $discountAmount = min($discountAmount, $totalPrice);

        $newTotalPrice = $totalPrice - $discountAmount;

        return [
            'success' => true,
            'new_total_price' => $newTotalPrice,
            'discount' => $discountAmount,
        ];
    }
}
