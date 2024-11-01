<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CouponService;
use App\Models\CartItem;

class CartController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function index()
    {
        $cartItems = CartItem::all();
        $total = $cartItems->sum(fn($item) => $item->price * $item->quantity);

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function applyCoupon(Request $request)
    {
        $cartItems = CartItem::all();
        $response = $this->couponService->applyCoupon($request->coupon_code, $cartItems);

        return response()->json($response);
    }
}
