<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store(StoreTransactionRequest $request)
    {
        // 1. Ambil Data Master
        $product = Product::where('id', $request->product_id)
            ->where('is_active', true)
            ->firstOrFail();

        $paymentMethod = PaymentMethod::findOrFail($request->payment_method_id);

        // 2. Hitung Total
        // Biaya Admin: Flat + (Total * Persen)
        $adminFee = $paymentMethod->admin_fee_flat + ($product->price_sell * ($paymentMethod->admin_fee_percent / 100));
        $grandTotal = $product->price_sell + $adminFee;

        // 3. Generate Invoice Code Unique
        $invoiceCode = 'INV-' . time() . '-' . rand(1000, 9999);

        // 4. DB Transaction untuk Integritas Data
        try {
            DB::beginTransaction();

            // Create Header
            $trx = Transaction::create([
                'invoice_code' => $invoiceCode,
                'payment_method_id' => $paymentMethod->id,
                'total_amount' => $grandTotal,
                'status' => 'pending',
                'customer_contact' => $request->customer_contact ?? null, // Optional
            ]);

            // Create Detail (Snapshot Data)
            TransactionDetail::create([
                'transaction_id' => $trx->id,
                'game_id' => $product->game_id,
                'product_id' => $product->id,
                'product_name_snapshot' => $product->name,
                'price_snapshot' => $product->price_sell,
                'target_uid' => $request->target_uid,
                'target_zone' => $request->target_zone,
            ]);

            DB::commit();

            // 5. Generate Payment URL (Dummy)
            // Di real world, request ke Midtrans/Xendit disini.
            // Simulasi: Kita return link ke frontend yang mengarah ke payment simulator.
            $paymentUrl = env('FRONTEND_URL', 'http://localhost:3000') . "/pay-simulation/" . $invoiceCode;

            return response()->json([
                'success' => true,
                'data' => [
                    'invoice' => $invoiceCode,
                    'total' => $grandTotal,
                    'payment_url' => $paymentUrl
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Order Failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function checkStatus($invoice_code)
    {
        $trx = Transaction::with(['details', 'paymentMethod'])
            ->where('invoice_code', $invoice_code)
            ->firstOrFail();

        return response()->json(['data' => $trx]);
    }

    public function callback(Request $request)
    {
        // Validasi basic
        $request->validate([
            'invoice_code' => 'required|exists:transactions,invoice_code',
            'status' => 'required|in:paid,failed,expired'
        ]);

        $trx = Transaction::where('invoice_code', $request->invoice_code)->first();

        if ($trx->status !== 'pending') {
            return response()->json(['message' => 'Transaction already processed'], 400);
        }

        $trx->update([
            'status' => $request->status,
            'paid_at' => $request->status === 'paid' ? now() : null
        ]);

        // Jika success, bisa trigger pengiriman item game disini (panggil API Provider)

        return response()->json(['message' => 'Status updated']);
    }
}
