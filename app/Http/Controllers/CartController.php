<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private $currentUserCart;

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $cart = $this->getCurrentUserCart();
        $cart->addLine($data);

        return response()->json([
            'message' => 'Added the product to the cart successfully',
            'data' => [
                'num_of_lines' => $cart->lines()->count(),
            ],
        ]);
    }

    public function total()
    {
        return response()->json([
            'data' => [
                'total' => $this->getCurrentUserCart()->getTotal(),
            ],
        ]);
    }

    private function getCurrentUserCart(): Cart
    {
        if(is_null($this->currentUserCart)) {
            $this->currentUserCart = Auth::user()->getCart();
        }

        return $this->currentUserCart;
    }
}
