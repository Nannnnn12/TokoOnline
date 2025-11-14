@extends('layouts.app')

@section('title', 'Keranjang - Toko Online')

@section('content')
    <div class="py-26">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($carts->count() > 0)
                        <div class="flex flex-col lg:flex-row gap-8">
                            <!-- Product List -->
                            <div class="flex-1">
                                <div class="space-y-4">
                                    @foreach ($carts as $cart)
                                        <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                                            <!-- Checkbox -->
                                            <input type="checkbox"
                                                class="cart-checkbox w-4 h-4 text-yellow-600 bg-gray-100 border-gray-300 rounded focus:ring-yellow-500"
                                                data-cart-id="{{ $cart->id }}"
                                                data-price="{{ $cart->product->sell_price }}"
                                                data-quantity="{{ $cart->quantity }}">

                                            <!-- Product Image -->
                                            <div class="flex-shrink-0">
                                                <img class="h-16 w-16 rounded-lg object-cover"
                                                    src="{{ $cart->product->images->first() ? asset('storage/' . $cart->product->images->first()->image_path) : asset('images/placeholder-product.png') }}"
                                                    alt="{{ $cart->product->name }}">
                                            </div>

                                            <!-- Product Details -->
                                            <div class="flex-1">
                                                <h3 class="text-lg font-medium text-gray-900">
                                                    {{ $cart->product->product_name }}</h3>
                                                <p class="text-sm text-gray-600">Rp
                                                    {{ number_format($cart->product->sell_price, 0, ',', '.') }}</p>
                                            </div>

                                            <!-- Quantity Controls -->
                                            <div class="flex items-center space-x-2">
                                                <button type="button"
                                                    class="quantity-btn p-1 border border-gray-300 rounded-md hover:bg-gray-50"
                                                    data-action="decrease" data-cart-id="{{ $cart->id }}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M20 12H4"></path>
                                                    </svg>
                                                </button>
                                                <input type="number"
                                                    class="no-spinner quantity-input w-16 px-2 py-1 border border-gray-300 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                                    value="{{ $cart->quantity }}" min="1"
                                                    max="{{ $cart->product->stock }}"
                                                    data-cart-id="{{ $cart->id }}">

                                                <button type="button"
                                                    class="quantity-btn p-1 border border-gray-300 rounded-md hover:bg-gray-50"
                                                    data-action="increase" data-cart-id="{{ $cart->id }}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Item Total -->
                                            <div class="text-right">
                                                <p class="text-lg font-semibold text-gray-900 item-total"
                                                    data-cart-id="{{ $cart->id }}">
                                                    Rp {{ number_format($cart->total, 0, ',', '.') }}
                                                </p>
                                            </div>

                                            <!-- Remove Button -->
                                            <form action="{{ route('cart.remove', $cart) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 p-1"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Cart Summary -->
                            <div class="lg:w-80">
                                <div class="bg-gray-50 p-6 rounded-lg sticky top-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Keranjang</h3>

                                    <div class="space-y-3 mb-6">
                                        <div class="flex justify-between text-sm">
                                            <span>Produk Terpilih:</span>
                                            <span id="selected-count">0</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span>Total Item:</span>
                                            <span id="total-items">{{ $carts->sum('quantity') }}</span>
                                        </div>
                                        <div class="border-t pt-3">
                                            <div class="flex justify-between text-lg font-semibold">
                                                <span>Total:</span>
                                                <span id="cart-total">Rp 0</span>
                                            </div>
                                        </div>
                                    </div>

                                    <button
                                        class="w-full bg-yellow-600 text-white px-4 py-3 rounded-lg hover:bg-yellow-700 transition-colors font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                                        id="checkout-btn" disabled onclick="proceedToCheckout()">
                                        Lanjut ke Checkout
                                    </button>

                                    <div class="mt-4 text-center">
                                        <a href="{{ route('products.index') }}"
                                            class="text-yellow-600 hover:text-yellow-800 text-sm">
                                            Lanjut Belanja
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">Keranjang Anda kosong.</p>
                            <a href="{{ route('products.index') }}"
                                class="mt-4 inline-block px-6 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                                Lanjut Belanja
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.cart-checkbox');
            const quantityButtons = document.querySelectorAll('.quantity-btn');
            const quantityInputs = document.querySelectorAll('.quantity-input');
            const checkoutBtn = document.getElementById('checkout-btn');
            const selectedCount = document.getElementById('selected-count');
            const totalItems = document.getElementById('total-items');
            const cartTotal = document.getElementById('cart-total');

            // CSRF token for AJAX requests
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                '{{ csrf_token() }}';

            // Update cart total and selected count
            function updateCartSummary() {
                let total = 0;
                let selected = 0;
                let totalQuantity = 0;

                checkboxes.forEach(checkbox => {
                    const quantity = parseInt(checkbox.dataset.quantity);
                    totalQuantity += quantity;

                    if (checkbox.checked) {
                        const price = parseInt(checkbox.dataset.price);
                        total += price * quantity;
                        selected += 1; // Count products, not quantity
                    }
                });

                selectedCount.textContent = selected;
                totalItems.textContent = totalQuantity;
                cartTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
                checkoutBtn.disabled = selected === 0;
            }

            // Handle checkbox changes
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateCartSummary();
                });
            });

            // Handle quantity changes
            quantityButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const cartId = this.dataset.cartId;
                    const action = this.dataset.action;
                    const quantityInput = document.querySelector(
                        `.quantity-input[data-cart-id="${cartId}"]`);
                    const checkbox = document.querySelector(
                        `.cart-checkbox[data-cart-id="${cartId}"]`);
                    let quantity = parseInt(quantityInput.value);
                    const maxStock = parseInt(quantityInput.max);

                    if (action === 'increase' && quantity < maxStock) {
                        quantity++;
                    } else if (action === 'decrease' && quantity > 1) {
                        quantity--;
                    }

                    quantityInput.value = quantity;
                    checkbox.dataset.quantity = quantity;

                    // Update item total
                    const itemTotal = document.querySelector(
                        `.item-total[data-cart-id="${cartId}"]`);
                    const price = parseInt(checkbox.dataset.price);
                    itemTotal.textContent = 'Rp ' + (price * quantity).toLocaleString('id-ID');

                    // Send AJAX request to update quantity
                    updateQuantity(cartId, quantity);
                    updateCartSummary();
                });
            });

            // Handle direct quantity input changes
            quantityInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const cartId = this.dataset.cartId;
                    const quantity = parseInt(this.value);
                    const maxStock = parseInt(this.max);
                    const checkbox = document.querySelector(
                        `.cart-checkbox[data-cart-id="${cartId}"]`);

                    if (quantity < 1) {
                        this.value = 1;
                        return;
                    }

                    if (quantity > maxStock) {
                        this.value = maxStock;
                        alert('Jumlah tidak boleh melebihi stok tersedia (' + maxStock + ')');
                        return;
                    }

                    checkbox.dataset.quantity = quantity;

                    // Update item total
                    const itemTotal = document.querySelector(
                        `.item-total[data-cart-id="${cartId}"]`);
                    const price = parseInt(checkbox.dataset.price);
                    itemTotal.textContent = 'Rp ' + (price * quantity).toLocaleString('id-ID');

                    // Send AJAX request to update quantity
                    updateQuantity(cartId, quantity);
                    updateCartSummary();
                });
            });

            // AJAX function to update quantity
            function updateQuantity(cartId, quantity) {
                fetch(`/cart/update/${cartId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            quantity: quantity,
                            _method: 'PATCH'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            console.error('Failed to update quantity');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            // Initialize cart summary
            updateCartSummary();
        });

        function proceedToCheckout() {
            const selectedCheckboxes = document.querySelectorAll('.cart-checkbox:checked');
            if (selectedCheckboxes.length === 0) {
                alert('Silakan pilih setidaknya satu item untuk checkout.');
                return;
            }

            const selectedCartIds = Array.from(selectedCheckboxes).map(cb => cb.dataset.cartId);
            const form = document.createElement('form');
            form.method = 'GET';
            form.action = '{{ route('checkout.index') }}';

            selectedCartIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'carts[]';
                input.value = id;
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        }
    </script>
@endsection
