@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Page Header -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Produk Kami</h1>
                <p class="text-gray-600">Jelajahi Koleksi Produk Luar Biasa Kami !!!</p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search and Filters Bar -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <form method="GET" action="{{ route('products.index') }}" class="space-y-4">
                <div class="flex flex-row flex-wrap gap-4 items-end">
                    <!-- Search Bar -->
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Produk:</label>
                        <div class="flex">
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                   placeholder="Search products..."
                                   class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                            <button type="submit" class="px-6 py-3 bg-yellow-600 text-white rounded-r-lg hover:bg-yellow-700 transition-colors font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Desktop Filters -->
                    <div class="hidden md:flex gap-4 items-end">
                        <!-- Category Filter -->
                        <div class="flex flex-col">
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori:</label>
                            <select name="category" id="category"
                                    class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sort Filter -->
                        <div class="flex flex-col">
                            <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Urutkan:</label>
                            <select name="sort" id="sort"
                                    class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                <option value="name" {{ request('sort', 'name') == 'name' ? 'selected' : '' }}>Abjad A-Z</option>
                                <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Harga</option>
                            </select>
                        </div>

                        <!-- Filter Button -->
                        <div class="flex flex-col">
                            <button type="submit" class="px-6 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors font-medium">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                Filter
                            </button>
                        </div>
                    </div>

                    <!-- Mobile Filters Row -->
                    <div class="md:hidden flex gap-2 items-end">
                        <!-- Category Filter -->
                        <div class="flex-1">
                            <label for="category_mobile" class="block text-sm font-medium text-gray-700 mb-1">Kategori:</label>
                            <select name="category" id="category_mobile"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 text-sm">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sort Filter -->
                        <div class="flex-1">
                            <label for="sort_mobile" class="block text-sm font-medium text-gray-700 mb-1">Urutkan:</label>
                            <select name="sort" id="sort_mobile"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 text-sm">
                                <option value="name" {{ request('sort', 'name') == 'name' ? 'selected' : '' }}>Abjad A-Z</option>
                                <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Harga</option>
                            </select>
                        </div>

                        <!-- Mobile Filter Button -->
                        <div class="flex flex-col">
                            <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors font-medium text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>


            </form>
        </div>

        <!-- Products Grid -->
        <div>
                @if($products->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($products as $product)
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                                <div class="aspect-w-1 aspect-h-1 bg-gray-200">
                                    @if($product->images->count() > 0)
                                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                             alt="{{ $product->product_name }}"
                                             class="w-full h-64 object-cover"
                                             onerror="this.onerror=null; this.src='{{ asset('images/placeholder-product.png') }}';">
                                    @else
                                        <div class="w-full h-64 bg-gray-300 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                        <a href="{{ route('products.show', $product) }}" class="hover:text-yellow-600 transition-colors">
                                            {{ $product->product_name }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-2xl font-bold text-yellow-600">Rp {{ number_format($product->sell_price, 0, ',', '.') }}</span>
                                        <a href="{{ route('products.show', $product) }}"
                                           class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors text-sm font-medium">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-5v2m0 0v2m0-2h2m-2 0h-2"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak Ada Product</h3>
                        <p class="mt-1 text-sm text-gray-500">Coba Cari Produk Atau Kategori yang lain</p>
                        <div class="mt-6">
                            <a href="{{ route('products.index') }}" class="text-yellow-600 hover:text-yellow-500">
                                Clear filter
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection
