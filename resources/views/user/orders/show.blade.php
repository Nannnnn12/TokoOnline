@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('orders.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Pesanan
                </a>
            </div>

            <!-- Order Header -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 px-6 py-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-white">
                                Pesanan #{{ $transaction->order_code }}
                            </h1>
                            <p class="text-blue-100 mt-1">
                                {{ $transaction->created_at->format('F d, Y \a\t H:i') }}
                            </p>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <span
                                class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                            @if ($transaction->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($transaction->status == 'processing')
                                bg-blue-100 text-blue-800
                            @elseif($transaction->status == 'shipped')
                                bg-yellow-100 text-yellow-800
                            @elseif($transaction->status == 'delivered')
                                bg-green-100 text-green-800
                            @else
                                bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="px-6 py-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Metode Pembayaran</h3>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ $transaction->payment_method == 'cod' ? 'Bayar di Tempat' : 'Pembayaran Online' }}
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Alamat Pengiriman</h3>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ $transaction->address ?? 'Alamat tidak disediakan' }}
                            </p>
                            @if ($transaction->province || $transaction->city || $transaction->district)
                                <p class="text-xs text-gray-600 mt-1">
                                    {{ $transaction->province }}, {{ $transaction->city }}, {{ $transaction->district }}
                                    @if ($transaction->postal_code)
                                        - {{ $transaction->postal_code }}
                                    @endif
                                </p>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Kurir & Layanan</h3>
                            <p class="mt-1 text-sm text-gray-900">
                                @if ($transaction->courier && $transaction->courier_service)
                                    {{ strtoupper($transaction->courier) }} - {{ $transaction->courier_service }}
                                @else
                                    Informasi kurir tidak tersedia
                                @endif
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Jumlah</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900">
                                Rp {{ number_format($transaction->total, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Item Pesanan</h2>
                </div>

                <div class="divide-y divide-gray-200">
                    @foreach ($transaction->items as $item)
                        <div class="px-6 py-4">
                            <div class="flex items-center space-x-4">
                                <!-- Product Image -->
                                <div class="flex-shrink-0">
                                    @if ($item->product->images->count() > 0)
                                        <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                                            alt="{{ $item->product->product_name }}"
                                            class="w-20 h-20 object-cover rounded-lg"
                                            onerror="this.onerror=null; this.src='{{ asset('images/placeholder-product.png') }}';">
                                    @else
                                        <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-medium text-gray-900">
                                        <a href="{{ route('products.show', $item->product) }}"
                                            class="hover:text-blue-600 transition-colors">
                                            {{ $item->product->product_name }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ Str::limit($item->product->description, 100) }}
                                    </p>
                                    <div class="flex items-center mt-2 space-x-4">
                                        <span class="text-sm text-gray-500">
                                            Jumlah: {{ $item->quantity }}
                                        </span>
                                        <span class="text-sm font-medium text-gray-900">
                                            Rp {{ number_format($item->price, 0, ',', '.') }} per item
                                        </span>
                                    </div>
                                </div>

                                <!-- Item Total -->
                                <div class="text-right">
                                    <p class="text-lg font-semibold text-gray-900">
                                        Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Total -->
                <div class="bg-gray-50 px-6 py-4">
                    <div class="flex justify-end">
                        <div class="w-full max-w-xs">
                            @php
                                $subtotal = $transaction->items->sum(function ($item) {
                                    return $item->quantity * $item->price;
                                });
                                $shippingCost = $transaction->shipping_cost;
                            @endphp
                            <div class="flex justify-between text-sm text-gray-600 mb-2">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600 mb-2">
                                <span>Pengiriman</span>
                                <span>{{ $shippingCost > 0 ? 'Rp ' . number_format($shippingCost, 0, ',', '.') : 'Gratis' }}</span>
                            </div>
                            <div class="border-t border-gray-300 pt-2">
                                <div class="flex justify-between text-lg font-semibold text-gray-900">
                                    <span>Total</span>
                                    <span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Status Timeline -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Status Pesanan</h2>
                    @if (in_array($transaction->status, ['shipped', 'delivered']))
                        <div class="flex items-center space-x-3">
                            <h3 id="tracking-label" class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                                Kode Resi:
                            </h3>

                            <div class="flex items-center space-x-2">
                                <span id="tracking-number" class="text-sm font-semibold text-gray-900 select-all">
                                    {{ $transaction->tracking_number ?? 'Belum tersedia' }}
                                </span>

                                <!-- Copy button -->
                                <button type="button" id="copy-tracking-btn"
                                    class="inline-flex items-center px-2 py-1 border border-gray-200 rounded-md text-xs bg-white hover:bg-gray-50 focus:outline-none"
                                    title="Salin nomor resi">
                                    <!-- simple copy icon (svg) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16h8M8 12h8M8 8h8M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Salin
                                </button>
                            </div>

                            <!-- feedback kecil -->
                            <span id="copy-feedback" class="ml-3 text-xs text-green-600 hidden">Tersalin!</span>
                        </div>
                    @endif
                </div>

                <div class="px-6 py-4">
                    <div class="space-y-4">
                        @php
                            $statuses = ['pending', 'processing', 'shipped', 'delivered'];
                            $currentStatusIndex = array_search($transaction->status, $statuses);
                        @endphp

                        @foreach ($statuses as $index => $status)
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-8 h-8 rounded-full flex items-center justify-center
                                    @if ($index <= $currentStatusIndex) bg-green-500 text-white
                                    @else
                                        bg-gray-300 text-gray-600 @endif">
                                        @if ($index < $currentStatusIndex)
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        @elseif($index == $currentStatusIndex)
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        @else
                                            <span class="text-sm font-medium">{{ $index + 1 }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 capitalize">
                                                {{ $status }}
                                            </p>
                                            @if ($index == $currentStatusIndex)
                                                <p class="text-xs text-gray-500">
                                                    Status saat ini
                                                </p>
                                            @endif
                                        </div>
                                        @if ($index <= $currentStatusIndex)
                                            <div class="text-xs text-gray-500">
                                                {{ $transaction->updated_at->format('M d, H:i') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if ($index < count($statuses) - 1)
                                <div class="ml-4 w-px h-8 bg-gray-300"></div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const copyBtn = document.getElementById('copy-tracking-btn');
            const trackingSpan = document.getElementById('tracking-number');
            const feedback = document.getElementById('copy-feedback');

            if (!copyBtn || !trackingSpan) return;

            async function showFeedback(text = 'Tersalin!', isError = false) {
                if (!feedback) return;
                feedback.textContent = text;
                feedback.classList.remove('hidden');
                feedback.classList.toggle('text-red-600', isError);
                feedback.classList.toggle('text-green-600', !isError);
                // hide after 1.6s
                setTimeout(() => {
                    feedback.classList.add('hidden');
                }, 1600);
            }

            async function copyToClipboard(text) {
                // Modern API (https, localhost)
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    try {
                        await navigator.clipboard.writeText(text);
                        return true;
                    } catch (err) {
                        // fallback below
                    }
                }

                // Fallback: create a temporary textarea, select and execCommand
                try {
                    const textarea = document.createElement('textarea');
                    textarea.value = text;
                    // avoid scrolling to bottom
                    textarea.style.position = 'fixed';
                    textarea.style.left = '-9999px';
                    document.body.appendChild(textarea);
                    textarea.select();
                    textarea.setSelectionRange(0, textarea.value.length);
                    const successful = document.execCommand('copy');
                    document.body.removeChild(textarea);
                    return successful;
                } catch (err) {
                    return false;
                }
            }

            copyBtn.addEventListener('click', async function() {
                const value = (trackingSpan.textContent || '').trim();
                if (!value || value.toLowerCase().includes('belum')) {
                    showFeedback('Nomor resi belum tersedia', true);
                    return;
                }

                const ok = await copyToClipboard(value);
                if (ok) {
                    showFeedback('Tersalin!');
                    // optional: briefly change button text or icon
                    copyBtn.classList.add('opacity-80');
                    setTimeout(() => copyBtn.classList.remove('opacity-80'), 800);
                } else {
                    showFeedback('Gagal menyalin', true);
                }
            });

            // optional: allow click on the number itself to copy
            trackingSpan?.addEventListener('click', async () => {
                const value = (trackingSpan.textContent || '').trim();
                if (!value || value.toLowerCase().includes('belum')) {
                    showFeedback('Nomor resi belum tersedia', true);
                    return;
                }
                const ok = await copyToClipboard(value);
                if (ok) showFeedback('Tersalin!');
                else showFeedback('Gagal menyalin', true);
            });
        });
    </script>

@endsection
