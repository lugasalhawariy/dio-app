<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Http\Requests\InventoryRequest;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();

        return JsonResponse::success($inventories, 'Inventories found', 200);
    }

    public function store(InventoryRequest $request)
    {
        $inventory = Inventory::create([
            'name' => $request->input('data.name'),
            'price' => $request->input('data.price'),
            'amount' => $request->input('data.amount'),
            'unit' => $request->input('data.unit'),
        ]);

        return JsonResponse::success($inventory, 'Inventory created', 201);
    }
}
