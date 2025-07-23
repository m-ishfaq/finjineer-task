<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventory::query();

        if ($request->has('location')) {
            $query->where('location', $request->location);
        }

        if ($request->has('product_name')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->product_name}%");
            });
        }

        $items = $query->with('product')->paginate(10);

        return response()->json($items);
    }

    public function show($id)
    {
        $item = Inventory::with('product')->findOrFail($id);
        return response()->json($item);
    }

    public function updateQuantity(Request $request, $id)
    {
        $validated = Validator::make($request->all(), ['quantity' => 'required|integer|min:0']);

        if ($validated->fails()) {
            return response()->json(['message' => 'Your request has following errors', 'errors' => $validated->errors()]);
        }

        $inventory = Inventory::findOrFail($id);
        $inventory->quantity = $request->quantity;
        $inventory->save();

        return response()->json(['message' => 'Quantity updated', 'inventory' => $inventory]);
    }
}
