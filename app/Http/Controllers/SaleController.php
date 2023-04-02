<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Http\Requests\SaleRequest;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::all();
        $sales->map(function($sale) {
            $sale->cart = json_decode($sale->cart);
        });

        return JsonResponse::success($sales, 'Sales found', 200);
    }

    public function show($uuid)
    {
        $sale = Sale::where('uuid', $uuid)->first();

        if(!$sale) {
            return JsonResponse::error('Sale not found', 404);
        }

        return JsonResponse::success($sale, 'Sale found', 200);
    }

    public function store(SaleRequest $request)
    {
        $cart = collect($request->input('data.cart'));
        $cart = $cart->map(function($item) {

            $product = Product::where('uuid', $item['product_uuid'])->first();

            $item['product_id'] = $product->id;
            $item['price'] = $product->price;
            $item['variants'] = $product->variants;

            return $item;
        });

        $sale = Sale::create([
            'payment_method' => $request->input('data.payment_method'),
            'cart' => json_encode($cart, JSON_UNESCAPED_UNICODE),
        ]);

        $sale->cart = json_decode($sale->cart);

        return JsonResponse::success($sale, 'Sale created', 201);
    }

    public function update(SaleRequest $request, $uuid)
    {
        $sale = Sale::where('uuid', $uuid)->first();

        if(!$sale) {
            return JsonResponse::error('Sale not found', 404);
        }

        $cart = collect($request->input('data.cart'));
        $cart = $cart->map(function($item) {
            $product = Product::where('uuid', $item['product_uuid'])->first();
            $item['product_id'] = $product->id;
            $item['price'] = $product->price;
            $item['variants'] = $product->variants;
            return $item;
        });

        $sale->cart = json_decode($cart, JSON_UNESCAPED_UNICODE);

        return JsonResponse::success($sale, 'Product added to sale', 200);
    }
}
