@extends('layouts.app')

@section('title', 'Pesanan Saya - Toko Online')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Pesanan Saya</h1>
                <p class="text-gray-600">Lacak dan kelola riwayat pesanan Anda</p>
            </div>

            <!-- Status Tabs -->
            <div class="mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-1">
                    <nav class="flex flex-nowrap overflow-x-auto gap-1 scrollbar-hide" aria-label="Tabs">
                        <a href="{{ route('orders.index', ['status' => 'all']) }}"
                            class="flex-shrink-0 md:flex-1 min-w-0 py-3 px-2 sm:px-4 rounded-lg font-medium text-xs sm:text-sm text-center transition-all duration-200 touch-manipulation
                       {{ request('status', 'all') == 'all' ? 'bg-yellow-500 text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                            <div class="flex items-center justify-center space-x-1 sm:space-x-2">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                                <span>Semua</span>
                            </div>
                        </a>
                        <a href="{{ route('orders.index', ['status' => 'belum_dibayar']) }}"
                            class="flex-shrink-0 md:flex-1 min-w-0 py-3 px-2 sm:px-4 rounded-lg font-medium text-xs sm:text-sm text-center transition-all duration-200 touch-manipulation
                       {{ request('status') == 'belum_dibayar' ? 'bg-red-500 text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                            <div class="flex items-center justify-center space-x-1 sm:space-x-2">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                                    </path>
                                </svg>
                                <span>Belum Dibayar</span>
                            </div>
                        </a>
                        <a href="{{ route('orders.index', ['status' => 'pending']) }}"
                            class="flex-shrink-0 md:flex-1 min-w-0 py-3 px-2 sm:px-4 rounded-lg font-medium text-xs sm:text-sm text-center transition-all duration-200 touch-manipulation
                       {{ request('status') == 'pending' ? 'bg-yellow-500 text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                            <div class="flex items-center justify-center space-x-1 sm:space-x-2">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Pending</span>
                            </div>
                        </a>
                        <a href="{{ route('orders.index', ['status' => 'processing']) }}"
                            class="flex-shrink-0 md:flex-1 min-w-0 py-3 px-2 sm:px-4 rounded-lg font-medium text-xs sm:text-sm text-center transition-all duration-200 touch-manipulation
                       {{ request('status') == 'processing' ? 'bg-blue-500 text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                            <div class="flex items-center justify-center space-x-1 sm:space-x-2">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Diproses</span>
                            </div>
                        </a>
                        <a href="{{ route('orders.index', ['status' => 'shipped']) }}"
                            class="flex-shrink-0 md:flex-1 min-w-0 py-3 px-2 sm:px-4 rounded-lg font-medium text-xs sm:text-sm text-center transition-all duration-200 touch-manipulation
                       {{ request('status') == 'shipped' ? 'bg-purple-500 text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                            <div class="flex items-center justify-center space-x-1 sm:space-x-2">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <span>Dikirim</span>
                            </div>
                        </a>
                        <a href="{{ route('orders.index', ['status' => 'delivered']) }}"
                            class="flex-shrink-0 md:flex-1 min-w-0 py-3 px-2 sm:px-4 rounded-lg font-medium text-xs sm:text-sm text-center transition-all duration-200 touch-manipulation
                       {{ request('status') == 'delivered' ? 'bg-green-500 text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                            <div class="flex items-center justify-center space-x-1 sm:space-x-2">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Diterima</span>
                            </div>
                        </a>
                        <a href="{{ route('orders.index', ['status' => 'dinilai']) }}"
                            class="flex-shrink-0 md:flex-1 min-w-0 py-3 px-2 sm:px-4 rounded-lg font-medium text-xs sm:text-sm text-center transition-all duration-200 touch-manipulation
                       {{ request('status') == 'dinilai' ? 'bg-blue-500 text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                            <div class="flex items-center justify-center space-x-1 sm:space-x-2">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                    </path>
                                </svg>
                                <span>Dinilai</span>
                            </div>
                        </a>
                    </nav>
                </div>
            </div>

            @if ($transactions->count() > 0)
                <div class="space-y-6">
                    @if (request('status') == 'dinilai')
                        {{-- 🔹 Sub-tabs untuk tab "Dinilai" --}}
                        <div class="mb-6">
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-1">
                                <nav class="flex flex-nowrap overflow-x-auto gap-1 scrollbar-hide" aria-label="Sub-tabs">
                                    <a href="{{ route('orders.index', ['status' => 'dinilai', 'sub_tab' => 'belum_dinilai']) }}"
                                        class="flex-1 min-w-0 py-3 px-2 sm:px-4 rounded-lg font-medium text-xs sm:text-sm text-center transition-all duration-200 touch-manipulation
                                       {{ $subTab == 'belum_dinilai' ? 'bg-yellow-500 text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                                        <div class="flex items-center justify-center space-x-1 sm:space-x-2">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                                </path>
                                            </svg>
                                            <span>Belum Dinilai</span>
                                        </div>
                                    </a>
                                    <a href="{{ route('orders.index', ['status' => 'dinilai', 'sub_tab' => 'lihat_review']) }}"
                                        class="flex-1 min-w-0 py-3 px-2 sm:px-4 rounded-lg font-medium text-xs sm:text-sm text-center transition-all duration-200 touch-manipulation
                                       {{ request('sub_tab') == 'lihat_review' ? 'bg-blue-500 text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                                        <div class="flex items-center justify-center space-x-1 sm:space-x-2">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                                </path>
                                            </svg>
                                            <span>Lihat Review</span>
                                        </div>
                                    </a>
                                </nav>
                            </div>
                        </div>

                        {{-- 🔹 Content for sub-tabs --}}
                        @if ($subTab == 'belum_dinilai')
                            @if ($filteredItems->count() > 0)
                                {{-- 🔹 Tampilkan items belum dinilai --}}
                                @foreach ($filteredItems as $data)
                                    <div
                                        class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                                            <div class="flex justify-between items-center">
                                                <div>
                                                    <h3 class="text-lg font-semibold text-gray-900">
                                                        Pesanan #{{ $data['transaction']->order_code }}
                                                    </h3>
                                                    <p class="text-sm text-gray-600">
                                                        {{ $data['transaction']->created_at->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y H:i') }}

                                                    </p>
                                                </div>
                                                <div>
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                        Diterima
                                                    </span>
                                                    <a href="{{ route('reviews.create', ['transactionId' => $data['transaction']->id, 'productId' => $data['item']->product_id]) }}"
                                                        class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-md text-sm font-medium hover:bg-yellow-600 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                            height="18" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" class="mr-2" stroke-width="2"
                                                            stroke-linejoin="round" stroke-linecap="round"
                                                            aria-hidden="true">
                                                            <title>Star</title>
                                                            <path
                                                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                                        </svg>
                                                        Nilai
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="px-6 py-4 flex items-center justify-between">
                                            <div class="flex items-center space-x-4">
                                                <div class="w-16 h-16">
                                                    @if ($data['item']->product->images->count() > 0)
                                                        <img src="{{ asset('storage/' . $data['item']->product->images->first()->image_path) }}"
                                                            alt="{{ $data['item']->product->product_name }}"
                                                            class="w-16 h-16 object-cover rounded-lg"
                                                            onerror="this.onerror=null; this.src='{{ asset('images/placeholder-product.png') }}';">
                                                    @else
                                                        <div
                                                            class="w-16 h-16 bg-gray-200 flex items-center justify-center rounded-lg">
                                                            <svg class="w-8 h-8 text-gray-400" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="text-base font-semibold text-gray-900">
                                                        {{ $data['item']->product->product_name }}</p>
                                                    <p class="text-sm text-gray-600">Jumlah: {{ $data['item']->quantity }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-lg font-semibold text-gray-900">
                                                    Rp
                                                    {{ number_format($data['item']->product->sell_price * $data['item']->quantity, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                {{-- 🔹 Tampilkan pesan jika belum dinilai kosong --}}
                                <div class="text-center py-16">
                                    <div
                                        class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada barang untuk dinilai
                                    </h3>
                                    <p class="text-gray-600 mb-6">Semua produk dalam pesanan Anda sudah dinilai. Terima
                                        kasih atas ulasan Anda!</p>
                                </div>
                            @endif
                        @elseif ($subTab == 'lihat_review')
                            {{-- 🔹 Tampilkan reviews --}}
                            <div class="bg-white rounded-2xl shadow-lg p-8">
                                <div class="flex items-center justify-between mb-8">
                                    <div>
                                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Ulasan Produk</h2>
                                        <p class="text-gray-600">{{ $filteredItems->count() }} ulasan</p>
                                    </div>
                                </div>

                                <div class="space-y-6">
                                    @foreach ($filteredItems as $data)
                                        <div class="border-b border-gray-100 pb-6 last:border-b-0 last:pb-0 mb-2">
                                            <div class="flex items-start space-x-4 mb-4">
                                                <!-- User Avatar -->
                                                <div
                                                    class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                                                    <span
                                                        class="text-white font-semibold text-lg">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                                </div>

                                                <!-- Review Content -->
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center justify-between mb-2">
                                                        <div class="flex items-center space-x-3">
                                                            <h4 class="text-lg font-semibold text-gray-900">
                                                                {{ auth()->user()->name }}
                                                            </h4>
                                                            <div class="flex text-yellow-400">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $data['review']->rating)
                                                                        <svg class="w-4 h-4 fill-current"
                                                                            viewBox="0 0 20 20">
                                                                            <path
                                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                                        </svg>
                                                                    @else
                                                                        <svg class="w-4 h-4 fill-gray-300"
                                                                            viewBox="0 0 20 20">
                                                                            <path
                                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                                        </svg>
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="text-sm text-gray-500">{{ $data['review']->created_at->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y') }}
                                                        </span>
                                                    </div>

                                                    <p class="text-gray-700 leading-relaxed mb-4">
                                                        {{ $data['review']->comment }}</p>

                                                    @if ($data['review']->image)
                                                        <div class="mt-4">
                                                            <img src="{{ $data['review']->image_url }}"
                                                                alt="Review image"
                                                                class="max-w-xs h-auto rounded-lg shadow-md">
                                                        </div>
                                                    @endif

                                                    <!-- Product Info -->
                                                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                                                        <div class="flex items-center space-x-3">
                                                            @if ($data['item']->product->images->count() > 0)
                                                                <a href="{{ route('products.show', $data['item']->product) }}"
                                                                    class="flex-shrink-0">
                                                                    <img src="{{ asset('storage/' . $data['item']->product->images->first()->image_path) }}"
                                                                        alt="{{ $data['item']->product->product_name }}"
                                                                        class="w-12 h-12 object-cover rounded-lg hover:opacity-80 transition-opacity">
                                                                </a>
                                                            @else
                                                                <a href="{{ route('products.show', $data['item']->product) }}"
                                                                    class="flex-shrink-0">
                                                                    <div
                                                                        class="w-12 h-12 bg-gray-200 flex items-center justify-center rounded-lg">
                                                                        <svg class="w-6 h-6 text-gray-400" fill="none"
                                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                        </svg>
                                                                    </div>
                                                                </a>
                                                            @endif
                                                            <div>
                                                                <p class="text-sm text-gray-600">Produk: <a
                                                                        href="{{ route('products.show', $data['item']->product) }}"
                                                                        class="font-medium text-blue-600 hover:text-blue-800">{{ $data['item']->product->product_name }}</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @else
                        {{-- 🔹 Tab lain tetap tampilan default --}}
                        @foreach ($transactions as $transaction)
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                                <!-- Order Header -->
                                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                        <div class="mb-2 sm:mb-0">
                                            <h3 class="text-lg font-semibold text-gray-900">
                                                Pesanan #{{ $transaction->order_code }}
                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                {{ $transaction->created_at->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y H:i') }}
                                            </p>
                                        </div>
                                        <div
                                            class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                                            <!-- Status Badge -->
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        @if ($transaction->status == 'belum_dibayar') bg-red-100 text-red-800
                                        @elseif($transaction->status == 'pending')
                                            bg-yellow-100 text-yellow-800
                                        @elseif($transaction->status == 'processing')
                                            bg-blue-100 text-blue-800
                                        @elseif($transaction->status == 'shipped')
                                            bg-purple-100 text-purple-800
                                        @elseif($transaction->status == 'delivered')
                                            bg-green-100 text-green-800
                                        @else
                                            bg-gray-100 text-gray-800 @endif">
                                                @if ($transaction->status == 'belum_dibayar')
                                                    Belum Dibayar
                                                @else
                                                    {{ ucfirst($transaction->status) }}
                                                @endif
                                            </span>
                                            <!-- Pay Button for Unpaid Midtrans Orders -->
                                            @if ($transaction->status == 'belum_dibayar' && $transaction->payment_method == 'midtrans')
                                                <a href="{{ route('payment.show', $transaction->order_code) }}"
                                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition-colors">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                        </path>
                                                    </svg>
                                                    Bayar
                                                </a>
                                            @endif
                                            <!-- View Details Button -->
                                            <a href="{{ route('orders.show', $transaction) }}"
                                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Items Preview -->
                                <div class="px-6 py-4">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                        <div class="flex-1 mb-4 sm:mb-0">
                                            <div class="flex items-center space-x-4">
                                                @if ($transaction->items->count() > 0)
                                                    @php $firstItem = $transaction->items->first(); @endphp
                                                    <div class="flex-shrink-0">
                                                        @if ($firstItem->product->images->count() > 0)
                                                            <img src="{{ asset('storage/' . $firstItem->product->images->first()->image_path) }}"
                                                                alt="{{ $firstItem->product->product_name }}"
                                                                class="w-16 h-16 object-cover rounded-lg"
                                                                onerror="this.onerror=null; this.src='{{ asset('images/placeholder-product.png') }}';">
                                                        @else
                                                            <div
                                                                class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                                <svg class="w-8 h-8 text-gray-400" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-gray-900 truncate">
                                                            {{ $firstItem->product->product_name }}
                                                        </p>
                                                        <p class="text-sm text-gray-500">
                                                            Jumlah: {{ $firstItem->quantity }}
                                                        </p>
                                                        @if ($transaction->items->count() > 1)
                                                            <p class="text-xs text-gray-400">
                                                                +{{ $transaction->items->count() - 1 }} item lagi
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
                                                {{ $transaction->payment_method == 'cod' ? 'Bayar di Tempat' : 'Pembayaran Online' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @endif

                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada pesanan</h3>
                    <p class="text-gray-600 mb-6">Ketika Anda melakukan pesanan pertama, pesanan akan muncul di sini.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
