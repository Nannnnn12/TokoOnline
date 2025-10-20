@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Product Images -->
                <div class="space-y-4">
                    <div class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden">
                        @if ($product->images->count() > 0)
                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                alt="{{ $product->product_name }}" class="w-full h-full object-cover" id="main-image"
                                onerror="this.onerror=null; this.src='{{ asset('images/placeholder-product.png') }}';">
                        @else
                            <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    @if ($product->images->count() > 1)
                        <div class="grid grid-cols-4 gap-4">
                            @foreach ($product->images as $image)
                                <button onclick="changeImage('{{ asset('storage/' . $image->image_path) }}')"
                                    class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden border-2 border-transparent hover:border-yellow-500 transition-colors">
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                        alt="{{ $product->product_name }}" class="w-full h-full object-cover"
                                        onerror="this.onerror=null; this.src='{{ asset('images/placeholder-product.png') }}';">
                                </button>
                            @endforeach
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
                                        class="text-gray-700 hover:text-yellow-600">Products</a>
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
                    </div>

                    <div class="prose prose-gray max-w-none">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                        <p class="text-gray-600">{{ $product->description }}</p>
                    </div>

                    <!-- Add to Cart Form -->
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        @auth
                            <form method="POST" action="{{ route('cart.add', $product) }}" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                                    <div class="flex items-center space-x-3">
                                        <button type="button" onclick="decrementQuantity()"
                                            class="p-2 border border-gray-300 rounded-md hover:bg-gray-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <input type="number" id="quantity" name="quantity" value="1" min="1"
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
                                    <button type="submit"
                                        class="w-full bg-yellow-600 text-white px-6 py-3 rounded-lg hover:bg-yellow-700 transition-colors font-medium">
                                        Add to Cart
                                    </button>

                                    @if (auth()->user()->address)
                                        <form method="POST" action="{{ route('checkout.store') }}"
                                            class="inline-block w-full">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1"
                                                id="checkout-quantity-{{ $product->id }}">
                                            <input type="hidden" name="payment_method" value="cod">
                                            <input type="hidden" name="address" value="{{ auth()->user()->address }}">

                                            <button type="submit"
                                                class="w-full bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-medium">
                                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                                </svg>
                                                Checkout Now
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('checkout.index', ['product_id' => $product->id, 'quantity' => 1]) }}"
                                            class="w-full bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-medium inline-block text-center">
                                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                            Checkout Now
                                        </a>
                                    @endif
                                </div>
                            </form>
                        @else
                            <div class="text-center">
                                <p class="text-gray-600 mb-4">Please sign in to add items to your cart.</p>
                                <a href="{{ route('login') }}"
                                    class="bg-yellow-600 text-white px-6 py-3 rounded-lg hover:bg-yellow-700 transition-colors font-medium inline-block">
                                    Sign In
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if ($relatedProducts->count() > 0)
                <div class="mt-16">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Products</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($relatedProducts as $relatedProduct)
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                                <div class="aspect-w-1 aspect-h-1 bg-gray-200">
                                    @if ($relatedProduct->images->count() > 0)
                                        <img src="{{ asset('storage/' . $relatedProduct->images->first()->image_path) }}"
                                            alt="{{ $relatedProduct->product_name }}" class="w-full h-48 object-cover"
                                            onerror="this.onerror=null; this.src='{{ asset('images/placeholder-product.png') }}';">
                                    @else
                                        <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                        <a href="{{ route('products.show', $relatedProduct) }}"
                                            class="hover:text-yellow-600 transition-colors">
                                            {{ $relatedProduct->product_name }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $relatedProduct->description }}
                                    </p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xl font-bold text-yellow-600">Rp
                                            {{ number_format($relatedProduct->sell_price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function changeImage(imageSrc) {
            document.getElementById('main-image').src = imageSrc;
        }

        function incrementQuantity() {
            const quantityInput = document.getElementById('quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
            updateCheckoutQuantity({{ $product->id }});
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
            const checkoutQuantityInput = document.getElementById('checkout-quantity-' + productId);
            checkoutQuantityInput.value = quantityInput.value;
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
                    Product {{ ucfirst(session('cart_action')) }}!
                </h3>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <div class="text-center mb-6">
                    <p class="text-gray-600 mb-4">
                        "{{ session('product_name') }}" has been successfully {{ session('cart_action') }} to your
                        cart
                        @if (session('cart_action') == 'added')
                            with quantity {{ session('quantity') }}
                        @else
                            (quantity increased by {{ session('quantity') }})
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
                            <span>Added to cart successfully</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Continue shopping or proceed to checkout
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            View your cart anytime
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
                        Continue Shopping
                    </button>
                    <button onclick="viewCart()"
                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M7 13l-1.1-5M7 13h10m0 0v8a2 2 0 01-2 2H9a2 2 0 01-2-2v-8z">
                            </path>
                        </svg>
                        View Cart
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
            document.getElementById('cartModal').style.display = 'none';
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
                    if (modal.style.display !== 'none') {
                        closeCartModal();
                    }
                }, 5000);
            }
        });
    </script>
@endif
@endsection
