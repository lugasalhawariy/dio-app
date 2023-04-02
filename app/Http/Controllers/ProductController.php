<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        $products->map(function($product) {
            $product->variants = json_decode($product->variants);
        });

        return JsonResponse::success($products, 'Products found', 200);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->input('data.name'),
            'description' => $request->input('data.description'),
            'price' => $request->input('data.price'),
            'variants' => json_encode(collect($request->input('data.variants'))),
        ]);

        $product->variants = json_decode($product->variants);

        return JsonResponse::success($product, 'Product created', 201);
    }

    public function show($uuid)
    {
        $product = Product::where('uuid', $uuid)->first();

        if(!$product) {
            return JsonResponse::error('Product not found', 404);
        }

        $product->variants = json_decode($product->variants);

        return JsonResponse::success($product, 'Product found', 200);
    }

    public function delete($uuid)
    {
        $product = Product::where('uuid', $uuid)->first();

        if(!$product) {
            return JsonResponse::error('Product not found', 404);
        }

        $product->delete();
        $product->inventory->delete();

        return JsonResponse::success(null, 'Product deleted', 204);
    }
}
