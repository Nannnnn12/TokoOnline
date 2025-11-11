<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::where('customer_id', Auth::id())
            ->with(['items.product']);

        // Filter by status if provided
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $transactions = $query->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.orders.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        // Ensure user can only view their own orders
        if ($transaction->customer_id !== Auth::id()) {
            abort(403);
        }

        $transaction->load(['items.product', 'customer']);

        return view('user.orders.show', compact('transaction'));
    }
}
