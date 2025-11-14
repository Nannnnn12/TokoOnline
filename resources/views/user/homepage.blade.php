@extends('layouts.app')

@section('title', 'Beranda - Toko Online')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-white to-yellow-50">
        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-gradient-to-r from-white to-yellow-100 py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                <div class="text-center">
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900">
                        Selamat Datang di
                        <span class="bg-gradient-to-r from-yellow-600 to-orange-600 bg-clip-text text-transparent">
                            {{ $store->store_name ?? 'TokoKu' }}
                        </span>
                    </h1>
                    <p class="py-8">{{ $store->description }}</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#products"
                            class="bg-gradient-to-r from-yellow-600 to-orange-600 text-white px-8 py-4 rounded-lg hover:from-yellow-700 hover:to-orange-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            Belanja Sekarang
                        </a>
                        <a href="#about"
                            class="border-2 border-yellow-600 text-yellow-600 px-8 py-4 rounded-lg hover:bg-yellow-600 hover:text-white transition-all duration-300 font-semibold">
                            Pelajari Selengkapnya
                        </a>
                    </div>
                </div>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute top-10 left-10 w-20 h-20 bg-yellow-200 rounded-full opacity-20 animate-pulse"></div>
            <div
                class="absolute bottom-10 right-10 w-32 h-32 bg-orange-200 rounded-full opacity-20 animate-pulse delay-1000">
            </div>
            <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-yellow-300 rounded-full opacity-30 animate-bounce"></div>
        </section>

        <!-- Features Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Mengapa Memilih Kami?</h2>
                    <p class="text-gray-600 text-lg">Kami menyediakan pengalaman berbelanja terbaik dengan produk
                        berkualitas dan
                        layanan yang sangat baik</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        class="text-center p-8 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Produk Berkualitas</h3>
                        <p class="text-gray-600">Kami dengan teliti memilih hanya produk berkualitas tertinggi untuk
                            pelanggan kami</p>
                    </div>

                    <div
                        class="text-center p-8 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Harga Terbaik</h3>
                        <p class="text-gray-600">Harga kompetitif dengan diskon reguler dan penawaran khusus</p>
                    </div>

                    <div
                        class="text-center p-8 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Pengiriman Cepat</h3>
                        <p class="text-gray-600">Pengiriman cepat dan andal untuk mendapatkan pesanan Anda secepat mungkin
                        </p>
                    </div>
                </div>
            </div>
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
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">
                                    {{ $product->description }}</p>
                                <div class="flex items-center space-x-1">
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
