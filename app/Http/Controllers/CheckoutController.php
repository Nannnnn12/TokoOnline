<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // Check if it's a direct product checkout
        if ($request->has('product_id')) {
            $productId = $request->input('product_id');
            $quantity = $request->input('quantity', 1);

            $product = \App\Models\Product::findOrFail($productId);
            $total = $product->sell_price * $quantity;

            // Create a temporary cart-like structure for single product
            $singleItem = (object) [
                'id' => 'single_' . $productId,
                'product' => $product,
                'quantity' => $quantity,
                'total' => $total
            ];

            return view('user.checkout', [
                'carts' => collect([$singleItem]),
                'total' => $total,
                'is_single_product' => true
            ]);
        }

        // Get selected cart items from request
        $selectedCartIds = $request->input('carts', []);

        if (empty($selectedCartIds)) {
            return redirect()->route('cart.index')->with('error', 'Please select items to checkout.');
        }

        $carts = Cart::whereIn('id', $selectedCartIds)
            ->where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Selected items not found.');
        }

        $total = $carts->sum(function ($cart) {
            return $cart->total;
        });

        return view('user.checkout', compact('carts', 'total'));
    }

    public function store(Request $request)
    {
        // Check if it's a direct product checkout or cart checkout
        if ($request->has('product_id')) {
            // Direct product checkout
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
                'address' => 'required|string|max:500',
                'payment_method' => 'required|in:cod,midtrans',
            ]);

            $product = \App\Models\Product::findOrFail($request->product_id);
            $total = $product->sell_price * $request->quantity;

            DB::transaction(function () use ($request, $product, $total) {
                // Check stock availability
                if ($product->stock < $request->quantity) {
                    throw new \Exception('Insufficient stock for product: ' . $product->product_name);
                }

                // Create transaction
                $transaction = Transaction::create([
                    'order_code' => 'ORD-' . strtoupper(Str::random(8)),
                    'customer_id' => Auth::id(),
                    'address' => $request->address,
                    'payment_method' => $request->payment_method,
                    'total' => $total,
                ]);

                // Create transaction item
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'price' => $product->sell_price,
                    'quantity' => $request->quantity,
                ]);

                // Decrease product stock
                $product->decrement('stock', $request->quantity);
            });

            return redirect()->route('products.index')->with('success', 'Order placed successfully!');
        } elseif ($request->has('is_single_product')) {
            // Single product checkout from checkout page
            $request->validate([
                'address' => 'required|string|max:500',
                'payment_method' => 'required|in:cod,midtrans',
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);

            $product = \App\Models\Product::findOrFail($request->product_id);
            $total = $product->sell_price * $request->quantity;

            $transaction = null;
            DB::transaction(function () use ($request, $product, $total, &$transaction) {
                // Check stock availability
                if ($product->stock < $request->quantity) {
                    throw new \Exception('Insufficient stock for product: ' . $product->product_name);
                }

                // Create transaction
                $transaction = Transaction::create([
                    'order_code' => 'ORD-' . strtoupper(Str::random(8)),
                    'customer_id' => Auth::id(),
                    'address' => $request->address,
                    'payment_method' => $request->payment_method,
                    'total' => $total,
                ]);

                // Create transaction item
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'price' => $product->sell_price,
                    'quantity' => $request->quantity,
                ]);

                // Decrease product stock
                $product->decrement('stock', $request->quantity);
            });

            return redirect()->back()->with([
                'show_success_modal' => true,
                'order_code' => $transaction->order_code,
                'order_total' => $total
            ]);
        } else {
            // Cart checkout
            $request->validate([
                'address' => 'required|string|max:500',
                'payment_method' => 'required|in:cod,midtrans',
                'notes' => 'nullable|string|max:500',
                'carts' => 'required|array|min:1',
                'carts.*' => 'exists:carts,id',
            ]);

            $selectedCartIds = $request->input('carts');
            $carts = Cart::whereIn('id', $selectedCartIds)
                ->where('user_id', Auth::id())
                ->with('product')
                ->get();

            if ($carts->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Selected items not found.');
            }

            $total = $carts->sum(function ($cart) {
                return $cart->total;
            });

            $transaction = null;
            DB::transaction(function () use ($request, $carts, $total, &$transaction) {
                // Check stock availability for all products
                foreach ($carts as $cart) {
                    if ($cart->product->stock < $cart->quantity) {
                        throw new \Exception('Insufficient stock for product: ' . $cart->product->product_name);
                    }
                }

                // Create transaction
                $transaction = Transaction::create([
                    'order_code' => 'ORD-' . strtoupper(Str::random(8)),
                    'customer_id' => Auth::id(),
                    'address' => $request->address,
                    'payment_method' => $request->payment_method,
                    'total' => $total,
                    'notes' => $request->notes,
                ]);

                // Create transaction items and decrease stock
                foreach ($carts as $cart) {
                    TransactionItem::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $cart->product_id,
                        'price' => $cart->product->sell_price,
                        'quantity' => $cart->quantity,
                    ]);

                    // Decrease product stock
                    $cart->product->decrement('stock', $cart->quantity);
                }

                // Remove items from cart
                Cart::whereIn('id', $carts->pluck('id'))->delete();
            });

            return redirect()->route('products.index')->with([
                'show_success_modal' => true,
                'order_code' => $transaction->order_code,
                'order_total' => $total
            ]);
        }
    }
}
