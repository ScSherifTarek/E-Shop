<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoringFormRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return ProductResource::collection($products);
    }
    
    public function store(ProductStoringFormRequest $request)
    {
        $data = $request->validated();
        
        $product = Auth::user()->products()->create($data);

        return new ProductResource($product);
    }
}
