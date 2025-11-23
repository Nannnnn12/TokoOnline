@extends('layouts.app')

@section('title', 'Beranda - Toko Online')

@section('content')
    <style>
        .swiper-wrapper {
            display: flex !important;
        }

        .swiper-slide {
            width: 100% !important;
            flex-shrink: 0 !important;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-white to-yellow-50">
        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-gradient-to-r from-white to-yellow-100 py-32">

            <div class="swiper mySwiper max-w-5xl mx-auto h-72 rounded-2xl overflow-hidden shadow-lg relative">

                <div class="swiper-wrapper">
                    @foreach ($sliderImages as $sliderImage)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $sliderImage->image_path) }}" alt="{{ $sliderImage->title ?? 'Slider Image' }}"
                                class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination"></div>

                <!-- Modern Navigation Buttons -->
                <div
                    class="swiper-button-next !w-12 !h-12 !rounded-full !bg-white/40 !shadow-lg !backdrop-blur-md hover:!bg-white/70 transition">
                </div>
                <div
                    class="swiper-button-prev !w-12 !h-12 !rounded-full !bg-white/40 !shadow-lg !backdrop-blur-md hover:!bg-white/70 transition">
                </div>


            </div>

            <!-- Categories Container -->
            <div class="max-w-5xl mx-auto mt-10 flex flex-wrap justify-center gap-6 px-4">
                @foreach ($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->id]) }}"
                        class="flex flex-col items-center space-y-2 bg-white rounded-lg p-4 shadow hover:shadow-lg transition">
                        @if (!empty($category->icon))
                            <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->category_name }}" title="{{ $category->category_name }}"
                                 class="w-16 h-16 object-contain">
                        @else
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center text-gray-400 text-xl">
                                {{ strtoupper(substr($category->category_name, 0, 2)) }}
                            </div>
                        @endif
                        <span class="text-gray-900 font-semibold">{{ $category->category_name }}</span>
                    </a>
                @endforeach
            </div>

            <!-- Decorative Elements -->
            <div class="absolute top-10 left-10 w-20 h-20 bg-yellow-200 rounded-full opacity-20 animate-pulse"></div>
            <div
                class="absolute bottom-10 right-10 w-32 h-32 bg-orange-200 rounded-full opacity-20 animate-pulse delay-1000">
            </div>
            <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-yellow-300 rounded-full opacity-30 animate-bounce"></div>
        </section>

        <!-- Products Preview Section -->
        <section id="products" class="py-20 bg-gradient-to-br from-yellow-50 to-orange-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Produk Unggulan</h2>
                    <p class="text-gray-600 text-lg">Lihat beberapa produk populer kami</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
                    @foreach ($products as $product)
                        <a href="{{ route('products.show', $product) }}"
                            class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 block">
                            <div class="relative overflow-hidden">
                                <div class="aspect-w-1 aspect-h-1 bg-gradient-to-br from-gray-100 to-gray-200">
                                    @if ($product->images->count() > 0)
                                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                            alt="{{ $product->product_name }}"
                                            class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                                            onerror="this.onerror=null; this.src='{{ asset('images/placeholder-product.png') }}';">
                                    @else
                                        <div
                                            class="w-full h-64 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <!-- Overlay with quick actions -->
                                <div
                                    class="absolute inset-0 bg-none bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                                    <div
                                        class="bg-white text-gray-900 px-6 py-3 rounded-full font-semibold opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 shadow-lg hover:shadow-xl">
                                        Lihat Detail
                                    </div>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-yellow-600 transition-colors">
                                    {{ $product->product_name }}
                                </h3>

                                <div class="flex flex-col items-start space-y-4">
                                    <div class="flex flex-col">
                                        <span class="text-xl font-bold text-yellow-600">Rp
                                            {{ number_format($product->sell_price, 0, ',', '.') }}</span>
                                        <span class="text-xs text-gray-500">Harga terbaik</span>
                                    </div>
                                    <div class="flex items-start space-y-1 space-x-2">
                                        <div class="flex items-center space-x-1 border-r border-gray-300 pr-2">
                                            <div class="flex text-yellow-400">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= round($product->reviews_avg_rating ?? 0))
                                                        <!-- Full star -->
                                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @else
                                                        <!-- Empty star -->
                                                        <svg class="w-4 h-4 fill-gray-300" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span
                                                class="text-xs text-gray-500 ml-1">({{ number_format($product->reviews_avg_rating ?? 0, 1) }})</span>
                                        </div>
                                        @if ($product->transaction_items_sum_quantity > 0)
                                            <span
                                                class="text-xs text-gray-500">{{ $product->transaction_items_sum_quantity }}
                                                terjual</span>
                                        @else
                                            <span class="text-xs text-gray-500">Belum Terjual</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>

                <div class="text-center mt-12">
                    <a href="/products"
                        class="bg-gradient-to-r from-yellow-600 to-orange-600 text-white px-8 py-4 rounded-lg hover:from-yellow-700 hover:to-orange-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        Lihat Semua Produk
                    </a>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">Tentang Toko Kami</h2>
                        <p class="text-gray-600 text-lg mb-6">
                            {{ $store->description ?? 'Kami berkomitmen untuk memberikan pengalaman berbelanja terbaik dengan produk yang dipilih secara teliti, harga kompetitif, dan layanan pelanggan yang luar biasa. Misi kami adalah membuat produk berkualitas dapat diakses oleh semua orang.' }}
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div
                                    class="w-6 h-6 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-700">Produk dengan jaminan kualitas</span>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-6 h-6 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-700">Pengiriman cepat dan aman</span>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-6 h-6 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-700">Dukungan pelanggan 24/7</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-yellow-100 to-orange-100 rounded-2xl p-8 shadow-2xl">
                            <div class="text-center">
                                <div
                                    class="w-24 h-24 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">Sangat Cepat</h3>
                                <p class="text-gray-600">Rasakan performa yang sangat cepat dengan platform kami yang
                                    dioptimalkan
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
