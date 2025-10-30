<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show($orderCode)
    {
        $transaction = Transaction::where('order_code', $orderCode)
            ->where('customer_id', auth()->id())
            ->with('items.product')
            ->firstOrFail();

        // Check if transaction has snap token
        if (!$transaction->snap_token) {
            return redirect()->route('orders.index')->with('error', 'Payment token not found.');
        }

        return view('user.payment', compact('transaction'));
    }
}
