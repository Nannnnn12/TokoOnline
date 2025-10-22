@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Product Images -->
                <div class="space-y-6">
                    <!-- Main Image Container -->
                    <div class="relative group">
                        <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300">
                            @if ($product->images->count() > 0)
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                    alt="{{ $product->product_name }}" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500" id="main-image"
                                    onerror="this.onerror=null; this.src='{{ asset('images/placeholder-product.png') }}';">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-32 h-32 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p class="text-gray-500 font-medium">No Image Available</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Zoom Icon Overlay -->
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Thumbnail Gallery -->
                    @if ($product->images->count() > 1)
                        <div class="grid grid-cols-4 sm:grid-cols-5 gap-2 sm:gap-3">
                            @foreach ($product->images as $index => $image)
                                <button onclick="changeImage('{{ asset('storage/' . $image->image_path) }}', {{ $index }})"
                                    class="aspect-square bg-gray-100 rounded-lg sm:rounded-xl overflow-hidden border-2 {{ $index === 0 ? 'border-yellow-500 shadow-lg' : 'border-transparent hover:border-yellow-400' }} transition-all duration-200 hover:shadow-md"
                                    id="thumb-{{ $index }}">
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                        alt="{{ $product->product_name }}" class="w-full h-full object-cover"
                                        onerror="this.onerror=null; this.src='{{ asset('images/placeholder-product.png') }}';">
                                </button>
                            @endforeach
                        </div>
                    @endif

                    <!-- Image Navigation Arrows (if more than 5 images) -->
                    @if ($product->images->count() > 5)
                        <div class="flex justify-center space-x-2 mt-4">
                            <button onclick="scrollThumbnails('left')" class="p-2 bg-white rounded-full shadow-md hover:shadow-lg transition-shadow">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button onclick="scrollThumbnails('right')" class="p-2 bg-white rounded-full shadow-md hover:shadow-lg transition-shadow">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="space-y-6">
                    <div>
                        <nav class="flex mb-4" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                                <li class="inline-flex items-center">
                                    <a href="{{ route('products.index') }}"
                                        class="text-gray-700 hover:text-yellow-600">Produk</a>
                                </li>
                                <li>
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span
                                            class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $product->category->name }}</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>

                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->product_name }}</h1>
                        <p class="text-xl font-semibold text-yellow-600 mb-4">Rp
                            {{ number_format($product->sell_price, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600 mb-4">Stock: {{ $product->stock > 0 ? $product->stock : 'Stok Habis' }}</p>
                    </div>

                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Deskripsi Produk</h3>
                        </div>

                        <div class="prose prose-gray max-w-none">
                            <div class="text-gray-700 leading-relaxed space-y-4">
                                @php
                                    $description = nl2br(e($product->description));
                                    $paragraphs = explode('<br />', $description);
                                @endphp

                                @foreach($paragraphs as $paragraph)
                                    @if(trim($paragraph))
                                        <p class="text-base leading-relaxed">{{ $paragraph }}</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Add to Cart Form -->
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        @auth
                            <form method="POST" action="{{ route('cart.add', $product) }}" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                                    <div class="flex items-center space-x-3">
                                        <button type="button" onclick="decrementQuantity()"
                                            class="p-2 border border-gray-300 rounded-md hover:bg-gray-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                            class="w-20 text-center px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-yellow-500 focus:border-yellow-500"
                                            onchange="updateCheckoutQuantity({{ $product->id }})">
                                        <button type="button" onclick="incrementQuantity()"
                                            class="p-2 border border-gray-300 rounded-md hover:bg-gray-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    @if($product->stock > 0)
                                        <button type="submit"
                                            class="w-full bg-yellow-600 text-white px-6 py-3 rounded-lg hover:bg-yellow-700 transition-colors font-medium">
                                            Tambah ke Keranjang
                                        </button>

                                        <a href="{{ route('checkout.index', ['product_id' => $product->id, 'quantity' => 1]) }}" id="checkout-link"
                                            class="w-full bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-medium inline-block text-center">
                                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                            Beli Sekarang
                                        </a>
                                    @else
                                        <button type="button" disabled
                                            class="w-full bg-gray-400 text-white px-6 py-3 rounded-lg cursor-not-allowed font-medium">
                                            Stok Habis
                                        </button>

                                        <button type="button" disabled
                                            class="w-full bg-gray-400 text-white px-6 py-3 rounded-lg cursor-not-allowed font-medium">
                                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                            Stok Habis
                                        </button>
                                    @endif
                                </div>
                            </form>
                        @else
                            <div class="text-center">
                                <p class="text-gray-600 mb-4">Silahkan Sign In Terlebih Dahulu</p>
                                <a href="{{ route('login') }}"
                                    class="bg-yellow-600 text-white px-6 py-3 rounded-lg hover:bg-yellow-700 transition-colors font-medium inline-block">
                                    Sign In
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeImage(imageSrc, index) {
            document.getElementById('main-image').src = imageSrc;

            // Update thumbnail selection
            const thumbnails = document.querySelectorAll('[id^="thumb-"]');
            thumbnails.forEach((thumb, i) => {
                if (i === index) {
                    thumb.classList.remove('border-transparent', 'hover:border-yellow-400');
                    thumb.classList.add('border-yellow-500', 'shadow-lg');
                } else {
                    thumb.classList.remove('border-yellow-500', 'shadow-lg');
                    thumb.classList.add('border-transparent', 'hover:border-yellow-400');
                }
            });
        }

        function scrollThumbnails(direction) {
            const container = document.querySelector('.grid.grid-cols-5');
            const scrollAmount = 200; // Adjust based on thumbnail size

            if (direction === 'left') {
                container.scrollLeft -= scrollAmount;
            } else {
                container.scrollLeft += scrollAmount;
            }
        }

        function incrementQuantity() {
            const quantityInput = document.getElementById('quantity');
            const currentValue = parseInt(quantityInput.value);
            const maxStock = {{ $product->stock }};
            if (currentValue < maxStock) {
                quantityInput.value = currentValue + 1;
                updateCheckoutQuantity({{ $product->id }});
            }
        }

        function decrementQuantity() {
            const quantityInput = document.getElementById('quantity');
            const currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
            updateCheckoutQuantity({{ $product->id }});
        }

        function updateCheckoutQuantity(productId) {
            const quantityInput = document.getElementById('quantity');
            const checkoutLink = document.getElementById('checkout-link');
            if (checkoutLink) {
                const url = new URL(checkoutLink.href);
                url.searchParams.set('quantity', quantityInput.value);
                checkoutLink.href = url.toString();
            }
        }
    </script>

<!-- Cart Success Modal -->
@if(session('show_cart_modal'))
<div id="cartModal" class="fixed inset-0 flex items-center justify-center z-50 p-4">
        <div
            class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-100">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-t-2xl p-6 text-center">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white">
                    Produk {{ ucfirst(session('cart_action')) }}!
                </h3>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <div class="text-center mb-6">
                    <p class="text-gray-600 mb-4">
                        "{{ session('product_name') }}" Telah Berhasil ditambahkan {{ session('cart_action') }} ke Keranjangmu
                        @if (session('cart_action') == 'added')
                            with quantity {{ session('quantity') }}
                        @else
                            (Jumlah Bertambah {{ session('quantity') }})
                        @endif
                        .
                    </p>

                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-center space-x-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Berhasil Tambah Ke Keranjan</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Lanjutkan Belanja atau Proses Checkout
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                           Lihat Keranjang Anda untuk melihat semua item
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-3">
                    <button onclick="continueShopping()"
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-4 rounded-xl transition-all duration-200 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Lanjutkan Belanja
                    </button>
                    <button onclick="viewCart()"
                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M7 13l-1.1-5M7 13h10m0 0v8a2 2 0 01-2 2H9a2 2 0 01-2-2v-8z">
                            </path>
                        </svg>
                        Lihat Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function continueShopping() {
            window.location.href = '{{ route('products.index') }}';
        }

        function viewCart() {
            window.location.href = '{{ route('cart.index') }}';
        }

        function closeCartModal() {
            const modal = document.getElementById('cartModal');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        // Close modal when clicking outside
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('cartModal');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeCartModal();
                    }
                });

                // Auto-close after 5 seconds
                setTimeout(function() {
                    const modalCheck = document.getElementById('cartModal');
                    if (modalCheck && modalCheck.style.display !== 'none') {
                        closeCartModal();
                    }
                }, 5000);
            }
        });
    </script>
@endif
@endsection
