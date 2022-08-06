<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Auth::user()->getCart();
        
        $cart->addLine($data);

        return response()->json([
            'message' => 'Added the product to the cart successfully',
        ]);
    }
}
