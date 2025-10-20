@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">My Orders</h1>
            <p class="text-gray-600">Track and manage your order history</p>
        </div>

        @if($transactions->count() > 0)
            <!-- Orders List -->
            <div class="space-y-6">
                @foreach($transactions as $transaction)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        <!-- Order Header -->
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                <div class="mb-2 sm:mb-0">
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        Order #{{ $transaction->order_code }}
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        Placed on {{ $transaction->created_at->format('M d, Y \a\t H:i') }}
                                    </p>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                                    <!-- Status Badge -->
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        @if($transaction->status == 'pending')
                                            bg-yellow-100 text-yellow-800
                                        @elseif($transaction->status == 'processing')
                                            bg-blue-100 text-blue-800
                                        @elseif($transaction->status == 'shipped')
                                            bg-purple-100 text-purple-800
                                        @elseif($transaction->status == 'delivered')
                                            bg-green-100 text-green-800
                                        @else
                                            bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                    <!-- View Details Button -->
                                    <a href="{{ route('orders.show', $transaction) }}"
                                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Order Items Preview -->
                        <div class="px-6 py-4">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                <div class="flex-1 mb-4 sm:mb-0">
                                    <div class="flex items-center space-x-4">
                                        @if($transaction->items->count() > 0)
                                            @php $firstItem = $transaction->items->first(); @endphp
                                            <div class="flex-shrink-0">
                                                @if($firstItem->product->images->count() > 0)
                                                    <img src="{{ asset('storage/' . $firstItem->product->images->first()->image_path) }}"
                                                         alt="{{ $firstItem->product->product_name }}"
                                                         class="w-16 h-16 object-cover rounded-lg"
                                                         onerror="this.onerror=null; this.src='{{ asset('images/placeholder-product.png') }}';">
                                                @else
                                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">
                                                    {{ $firstItem->product->product_name }}
                                                </p>
                                                <p class="text-sm text-gray-500">
                                                    Quantity: {{ $firstItem->quantity }}
                                                </p>
                                                @if($transaction->items->count() > 1)
                                                    <p class="text-xs text-gray-400">
                                                        +{{ $transaction->items->count() - 1 }} more item{{ $transaction->items->count() > 2 ? 's' : '' }}
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Order Total -->
                                <div class="text-right">
                                    <p class="text-lg font-semibold text-gray-900">
                                        Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        {{ $transaction->payment_method == 'cod' ? 'Cash on Delivery' : 'Online Payment' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $transactions->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No orders yet</h3>
                <p class="text-gray-600 mb-6">When you place your first order, it will appear here.</p>
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center px-6 py-3 bg-yellow-600 text-white font-medium rounded-lg hover:bg-yellow-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
