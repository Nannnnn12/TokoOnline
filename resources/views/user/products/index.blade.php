@extends('layouts.app')

@section('title', 'Produk - Toko Online')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-50">

        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Search and Filters Bar -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-6 sm:p-8 mb-12">
                <div class="space-y-6">
                    <div class="flex flex-col lg:flex-row gap-6 lg:items-end">
                        <!-- Search Bar -->
                        <div class="w-full lg:flex-1">
                            <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">Cari Produk:</label>
                            <div class="relative">
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    placeholder="Cari produk favorit Anda..."
                                    class="w-full pl-10 pr-12 py-3 sm:py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 text-gray-900 placeholder-gray-400"
                                    onchange="applyFilters()">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <button type="button" id="clear-search"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 w-6 h-6 text-gray-400 hover:text-gray-600 transition-colors duration-200"
                                    onclick="clearSearch()">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Desktop Filters -->
                        <div class="hidden lg:flex gap-6 items-end">
                            <!-- Category Filter -->
                            <div class="flex flex-col">
                                <label for="category"
                                    class="block text-sm font-semibold text-gray-700 mb-2">Kategori:</label>
                                <select name="category" id="category"
                                    class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 bg-white"
                                    onchange="applyFilters()">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sort Filter -->
                            <div class="flex flex-col">
                                <label for="sort"
                                    class="block text-sm font-semibold text-gray-700 mb-2">Urutkan:</label>
                                <select name="sort" id="sort"
                                    class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 bg-white"
                                    onchange="applyFilters()">
                                    <option value="product_name"
                                        {{ request('sort', 'product_name') == 'product_name' ? 'selected' : '' }}>Abjad A-Z
                                    </option>
                                    <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Harga</option>
                                </select>
                            </div>
                        </div>

                        <!-- Mobile Filters -->
                        <div class="lg:hidden grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 w-full">
                            <!-- Category Filter -->
                            <div class="flex flex-col">
                                <label for="category_mobile"
                                    class="block text-sm font-semibold text-gray-700 mb-2">Kategori:</label>
                                <select name="category" id="category_mobile"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 bg-white text-sm"
                                    onchange="applyFiltersMobile()">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sort Filter -->
                            <div class="flex flex-col">
                                <label for="sort_mobile"
                                    class="block text-sm font-semibold text-gray-700 mb-2">Urutkan:</label>
                                <select name="sort" id="sort_mobile"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 bg-white text-sm"
                                    onchange="applyFiltersMobile()">
                                    <option value="product_name"
                                        {{ request('sort', 'product_name') == 'product_name' ? 'selected' : '' }}>Abjad A-Z
                                    </option>
                                    <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Harga
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Products Grid -->
            <div class="bg-white/50 backdrop-blur-sm rounded-3xl p-8 shadow-2xl border border-white/20">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Koleksi Produk</h2>
                    <div class="text-sm text-gray-600">
                        Menampilkan {{ $products->count() }} produk
                    </div>
                </div>

                @if ($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-8">
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
                                        @php
                                            $desc = strip_tags($product->description);
                                            $desc = preg_replace('/(?<=[a-zA-Z])(?=[A-Z])/', ' ', $desc); 
                                            $desc = str_replace(',', ', ', $desc);
                                            $desc = str_replace('bahan', ' bahan', $desc);
                                            $desc = Str::limit($desc, 100);
                                        @endphp

                                        {!! $desc !!}
                                    <div class="flex justify-between items-center">
                                        <div class="flex flex-col">
                                            <span class="text-xl font-bold text-yellow-600">Rp
                                                {{ number_format($product->sell_price, 0, ',', '.') }}</span>
                                            <span class="text-xs text-gray-500">Harga terbaik</span>
                                        </div>
                                        <div class="flex flex-col items-end space-y-1">
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
                                            @if ($product->transaction_items_sum_quantity > 0)
                                                <span
                                                    class="text-xs text-gray-500">{{ $product->transaction_items_sum_quantity }}
                                                    terjual</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-16">
                        <div
                            class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-5v2m0 0v2m0-2h2m-2 0h-2">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak Ada Produk Ditemukan</h3>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">Coba cari produk dengan kata kunci berbeda atau
                            pilih kategori yang lain</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <a href="{{ route('products.index') }}"
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-xl hover:from-yellow-600 hover:to-yellow-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Reset Filter
                            </a>
                            <a href="{{ route('home') }}"
                                class="inline-flex items-center px-6 py-3 bg-white text-gray-700 border-2 border-gray-200 rounded-xl hover:border-gray-300 transition-all duration-200 font-semibold shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>



@endsection

<script>
    // Desktop filters function
    function applyFilters() {
        const search = document.getElementById('search').value;
        const category = document.getElementById('category').value;
        const sort = document.getElementById('sort').value;

        // Build query string
        const params = new URLSearchParams();

        if (search) params.append('search', search);
        if (category) params.append('category', category);
        if (sort) params.append('sort', sort);

        // Redirect to the same page with filters
        const url = '{{ route('products.index') }}' + (params.toString() ? '?' + params.toString() : '');
        window.location.href = url;
    }

    // Mobile filters function
    function applyFiltersMobile() {
        const search = document.getElementById('search').value;
        const category = document.getElementById('category_mobile').value;
        const sort = document.getElementById('sort_mobile').value;

        // Build query string
        const params = new URLSearchParams();

        if (search) params.append('search', search);
        if (category) params.append('category', category);
        if (sort) params.append('sort', sort);

        // Redirect to the same page with filters
        const url = '{{ route('products.index') }}' + (params.toString() ? '?' + params.toString() : '');
        window.location.href = url;
    }

    // Add debounce for search input to avoid too many requests
    let searchTimeout;
    document.getElementById('search').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            // Check if we're on mobile or desktop and call appropriate function
            if (window.innerWidth < 1024) {
                applyFiltersMobile();
            } else {
                applyFilters();
            }
        }, 500); // Wait 500ms after user stops typing
    });

    // Function to clear search
    function clearSearch() {
        document.getElementById('search').value = '';
        // Check if we're on mobile or desktop and call appropriate function
        if (window.innerWidth < 1024) {
            applyFiltersMobile();
        } else {
            applyFilters();
        }
    }
</script>
