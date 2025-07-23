<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Transaction;
use App\Models\TransactionLog;
use App\Services\PricingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    private $pricingService;

    public function __construct(PricingService $pricingService)
    {
        $this->pricingService = $pricingService;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),         [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:sale,restock',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Your request has following errors', 'errors' => $validator->errors()]);
        }

        DB::beginTransaction();

        try {
            $productId = $request->product_id;
            $quantity = $request->quantity;
            $type = $request->type;

            // used  lockForUpdate() to prevent from race condition in DB (For Concurrent Orders) if we have low quantity 
            $inventory = Inventory::where('product_id', $productId)->lockForUpdate()->firstOrFail();

            if ($type === 'sale' && $inventory->quantity < $quantity) {
                return response()->json(['error' => 'Insufficient stock'], 400);
            }

            $pricePerUnit = $this->pricingService->getPrice($productId, $quantity);

            // update inventory based on transaction type (sale, restock)
            if ($type === 'sale') {
                $inventory->quantity -= $quantity;
            } else {
                $inventory->quantity += $quantity;
            }
            $inventory->save();

            $transaction = Transaction::create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'type' => $type,
                'price' => $pricePerUnit * $quantity,
            ]);

            TransactionLog::create([
                'transaction_id' => $transaction->id,
                'data' => json_encode([
                    'inventory_before' => $inventory->quantity + ($type === 'sale' ? $quantity : -$quantity),
                    'inventory_after' => $inventory->quantity,
                    'type' => $type,
                    'quantity' => $quantity,
                    'price' => number_format($pricePerUnit * $quantity, 3),
                    'timestamp' => now(),
                ]),
            ]);

            DB::commit();

            return response()->json(['message' => 'Transaction processed', 'transaction' => $transaction]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
