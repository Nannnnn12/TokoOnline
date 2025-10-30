<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-8">
                <div class="flex items-center space-x-3">
                    @if (isset($store) && $store->logo)
                        <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->store_name ?? 'Store Logo' }}"
                            class="h-10 w-auto">
                        <h1
                            class="text-2xl font-bold bg-gradient-to-r from-yellow-600 to-orange-600 bg-clip-text text-transparent">
                            {{ $store->store_name }}</h1>
                    @else
                        <h1
                            class="text-2xl font-bold bg-gradient-to-r from-yellow-600 to-orange-600 bg-clip-text text-transparent">
                            {{ $store->store_name ?? 'TokoKu' }}
                        </h1>
                    @endif
                </div>

                <!-- Navigation Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="/"
                        class="text-gray-600 hover:text-yellow-600 transition-all duration-200 font-medium relative group">
                        Beranda
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-yellow-600 to-orange-600 transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="/products"
                        class="text-gray-600 hover:text-yellow-600 transition-all duration-200 font-medium relative group">
                        Produk
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-yellow-600 to-orange-600 transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="/contact"
                        class="text-gray-600 hover:text-yellow-600 transition-all duration-200 font-medium relative group">
                        Kontak
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-yellow-600 to-orange-600 transition-all duration-200 group-hover:w-full"></span>
                    </a>
                </div>
            </div>

            <!-- User Actions -->
            <div class="flex items-center space-x-4">
                @auth
                    @if (auth()->user()->role === 'user')
                        <!-- Cart Button -->
                        <a href="{{ route('cart.index') }}"
                            class="relative text-gray-600 hover:text-yellow-600 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>

                            @php
                                $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
                            @endphp
                            @if ($cartCount > 0)
                                <span
                                    class="absolute -top-2 -right-2 bg-gradient-to-r from-yellow-600 to-orange-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    @endif

                    <!-- User Dropdown -->
                    <div class="relative" id="user-dropdown">
                        <button onclick="toggleDropdown()"
                            class="flex items-center space-x-2 text-gray-600 hover:text-yellow-600 transition-all duration-200 font-medium">
                            @if (auth()->user()->profile_image)
                                <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile"
                                    class="w-8 h-8 rounded-full object-cover border-2 border-gray-200">
                            @else
                                <div
                                    class="w-8 h-8 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-full flex items-center justify-center">
                                    <span
                                        class="text-white text-sm font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <span class="hidden sm:block">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200" id="dropdown-arrow" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="dropdown-menu"
                            class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                            <div class="py-1">
                                <div class="px-4 py-2 text-sm text-gray-700 border-b border-gray-200">
                                    <div class="font-medium">{{ auth()->user()->name }}</div>
                                    <div class="text-gray-500">{{ auth()->user()->email }}</div>
                                    <div class="text-xs text-gray-400 capitalize">{{ auth()->user()->role }}</div>
                                </div>

                                @if (auth()->user()->role === 'admin')
                                    <a href="/admin"
                                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Admin Panel
                                    </a>
                                @endif

                                <a href="/profile"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profil
                                </a>
                                @if (auth()->user()->role === 'user')
                                    <a href="{{ route('orders.index') }}"
                                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                            </path>
                                        </svg>
                                        Pesanan Saya
                                    </a>
                                @endif

                                <form method="POST" action="/logout" class="block">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-gray-600 hover:text-yellow-600 transition-all duration-200 font-medium relative group">
                        Sign In
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-yellow-600 to-orange-600 transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-gradient-to-r from-yellow-600 to-orange-600 text-white px-6 py-2.5 rounded-lg hover:from-yellow-700 hover:to-orange-700 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Sign Up
                    </a>
                @endauth

                <!-- Mobile Menu Button -->
                <button onclick="toggleMobileMenu()"
                    class="lg:hidden p-2 rounded-lg text-gray-600 hover:text-yellow-600 transition-colors"
                    id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div class="lg:hidden hidden pb-4" id="mobile-menu">
            <div class="flex flex-col space-y-2">
                <a href="/"
                    class="text-gray-600 hover:text-yellow-600 transition-all duration-200 font-medium py-2 px-4 rounded-lg hover:bg-gray-50">
                    Beranda
                </a>
                <a href="/products"
                    class="text-gray-600 hover:text-yellow-600 transition-all duration-200 font-medium py-2 px-4 rounded-lg hover:bg-gray-50">
                    Produk
                </a>
                <a href="/categories"
                    class="text-gray-600 hover:text-yellow-600 transition-all duration-200 font-medium py-2 px-4 rounded-lg hover:bg-gray-50">
                    Kategori
                </a>
                <a href="/contact"
                    class="text-gray-600 hover:text-yellow-600 transition-all duration-200 font-medium py-2 px-4 rounded-lg hover:bg-gray-50">
                    Kontak
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleDropdown() {
        const menu = document.getElementById('dropdown-menu');
        const arrow = document.getElementById('dropdown-arrow');

        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        } else {
            menu.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    }

    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const button = document.getElementById('mobile-menu-button');

        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
        } else {
            menu.classList.add('hidden');
        }
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('user-dropdown');
        const menu = document.getElementById('dropdown-menu');
        const arrow = document.getElementById('dropdown-arrow');

        if (dropdown && !dropdown.contains(event.target)) {
            menu.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    });
</script>
