@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-white to-yellow-50">
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-r from-white to-yellow-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
                    Welcome to
                    <span class="bg-gradient-to-r from-yellow-600 to-orange-600 bg-clip-text text-transparent">
                        {{ $store->store_name ?? 'TokoKu' }}
                    </span>
                </h1>
                <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                    {{ $store->description ?? 'Discover amazing products at our online store. Quality products, great prices, and excellent service.' }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#products" class="bg-gradient-to-r from-yellow-600 to-orange-600 text-white px-8 py-4 rounded-lg hover:from-yellow-700 hover:to-orange-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        Shop Now
                    </a>
                    <a href="#about" class="border-2 border-yellow-600 text-yellow-600 px-8 py-4 rounded-lg hover:bg-yellow-600 hover:text-white transition-all duration-300 font-semibold">
                        Learn More
                    </a>
                </div>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-yellow-200 rounded-full opacity-20 animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-32 h-32 bg-orange-200 rounded-full opacity-20 animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-yellow-300 rounded-full opacity-30 animate-bounce"></div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose Us?</h2>
                <p class="text-gray-600 text-lg">We provide the best shopping experience with quality products and excellent service</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Quality Products</h3>
                    <p class="text-gray-600">We carefully select only the highest quality products for our customers</p>
                </div>

                <div class="text-center p-8 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Best Prices</h3>
                    <p class="text-gray-600">Competitive pricing with regular discounts and special offers</p>
                </div>

                <div class="text-center p-8 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Fast Delivery</h3>
                    <p class="text-gray-600">Quick and reliable shipping to get your orders to you as soon as possible</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Preview Section -->
    <section id="products" class="py-20 bg-gradient-to-br from-yellow-50 to-orange-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Products</h2>
                <p class="text-gray-600 text-lg">Check out some of our popular products</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Product cards will be populated dynamically -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Sample Product</h3>
                        <p class="text-gray-600 text-sm mb-4">High quality product description</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-yellow-600">$29.99</span>
                            <button class="bg-gradient-to-r from-yellow-600 to-orange-600 text-white px-4 py-2 rounded-lg hover:from-yellow-700 hover:to-orange-700 transition-all duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Repeat for more products -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Another Product</h3>
                        <p class="text-gray-600 text-sm mb-4">Premium quality item</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-yellow-600">$49.99</span>
                            <button class="bg-gradient-to-r from-yellow-600 to-orange-600 text-white px-4 py-2 rounded-lg hover:from-yellow-700 hover:to-orange-700 transition-all duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Special Item</h3>
                        <p class="text-gray-600 text-sm mb-4">Limited edition product</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-yellow-600">$79.99</span>
                            <button class="bg-gradient-to-r from-yellow-600 to-orange-600 text-white px-4 py-2 rounded-lg hover:from-yellow-700 hover:to-orange-700 transition-all duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Best Seller</h3>
                        <p class="text-gray-600 text-sm mb-4">Customer favorite</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-yellow-600">$39.99</span>
                            <button class="bg-gradient-to-r from-yellow-600 to-orange-600 text-white px-4 py-2 rounded-lg hover:from-yellow-700 hover:to-orange-700 transition-all duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="/products" class="bg-gradient-to-r from-yellow-600 to-orange-600 text-white px-8 py-4 rounded-lg hover:from-yellow-700 hover:to-orange-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    View All Products
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">About Our Store</h2>
                    <p class="text-gray-600 text-lg mb-6">
                        {{ $store->description ?? 'We are committed to providing the best shopping experience with carefully curated products, competitive pricing, and exceptional customer service. Our mission is to make quality products accessible to everyone.' }}
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Quality guaranteed products</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Fast and secure shipping</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">24/7 customer support</span>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="bg-gradient-to-br from-yellow-100 to-orange-100 rounded-2xl p-8 shadow-2xl">
                        <div class="text-center">
                            <div class="w-24 h-24 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Lightning Fast</h3>
                            <p class="text-gray-600">Experience blazing fast performance with our optimized platform</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
