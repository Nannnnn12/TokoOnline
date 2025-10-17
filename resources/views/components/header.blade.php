<nav class="bg-white/90 backdrop-blur-lg shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-8">
                <div class="flex items-center space-x-3">
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-yellow-600 to-orange-600 bg-clip-text text-transparent">
                        TokoKu
                    </h1>
                </div>

                <!-- Navigation Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="#" class="text-gray-600 hover:text-yellow-600  text-gray-300  hover:text-yellow-400 transition-all duration-200 font-medium relative group">
                        Home
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-yellow-600 to-orange-600 transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="/products" class="text-gray-600 hover:text-yellow-600  text-gray-300  hover:text-yellow-400 transition-all duration-200 font-medium relative group">
                        Products
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-yellow-600 to-orange-600 transition-all duration-200 group-hover:w-full"></span>
                    </a>
                </div>
            </div>

            <!-- User Actions -->
            <div class="flex items-center space-x-4">
                @auth
                @if(auth()->user()->role === 'user')
                    <!-- Cart Button -->
                    <a href="/cart" class="relative text-gray-600 hover:text-indigo-600  text-gray-300  hover:text-indigo-400 transition-all duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                        </svg>
                        <span class="absolute -top-2 -right-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center" wire:poll.5s="updateCartCount" wire:refresh="refreshCart">
                            1
                        </span>
                    </a>
                @endif

                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-indigo-600  text-gray-300  hover:text-indigo-400 transition-all duration-200 font-medium">
                            <div class="w-8 h-8 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <span class="hidden sm:block">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-white  bg-gray-800 rounded-lg shadow-lg border border-gray-200  border-gray-700 z-50">
                            <div class="py-1">
                                <div class="px-4 py-2 text-sm text-gray-700  text-gray-300 border-b border-gray-200  border-gray-700">
                                    <div class="font-medium">{{ auth()->user()->name }}</div>
                                    <div class="text-gray-500  text-gray-400">{{ auth()->user()->email }}</div>
                                    <div class="text-xs text-gray-400  text-gray-500 capitalize">{{ auth()->user()->role }}</div>
                                </div>

                                @if(auth()->user()->role === 'admin')
                                    <a href="/admin" class="flex items-center px-4 py-2 text-sm text-gray-700  text-gray-300 hover:bg-gray-100  hover:bg-gray-700 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Admin Panel
                                    </a>
                                @endif

                                <a href="/profile" class="flex items-center px-4 py-2 text-sm text-gray-700  text-gray-300 hover:bg-gray-100  hover:bg-gray-700 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profile
                                </a>
                                @if(auth()->user()->role === 'user')
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700  text-gray-300 hover:bg-gray-100  hover:bg-gray-700 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 6h18M3 14h18M3 18h18"></path>
                                    </svg>
                                    My Orders
                                </a>
                                @endif

                                <form method="POST" action="/logout" class="block">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-sm text-gray-700  text-gray-300 hover:bg-gray-100  hover:bg-gray-700 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="/signin" class="text-gray-600 hover:text-indigo-600  text-gray-300  hover:text-indigo-400 transition-all duration-200 font-medium relative group">
                        Sign In
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="/signup" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2.5 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Sign Up
                    </a>
                @endauth

                <!-- Mobile Menu Button -->
                <button class="lg:hidden p-2 rounded-lg text-gray-600 hover:text-indigo-600  text-gray-300  hover:text-indigo-400 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu (Hidden by default) -->
        <div class="lg:hidden hidden pb-4">
            <div class="flex flex-col space-y-2">
                <a href="/" class="text-gray-600 hover:text-indigo-600  text-gray-300  hover:text-indigo-400 transition-all duration-200 font-medium py-2 px-4 rounded-lg hover:bg-gray-50  hover:bg-gray-800">
                    Home
                </a>
                <a href="/products" class="text-gray-600 hover:text-indigo-600  text-gray-300  hover:text-indigo-400 transition-all duration-200 font-medium py-2 px-4 rounded-lg hover:bg-gray-50  hover:bg-gray-800">
                    Products
                </a>
                <a href="/categories" class="text-gray-600 hover:text-indigo-600  text-gray-300  hover:text-indigo-400 transition-all duration-200 font-medium py-2 px-4 rounded-lg hover:bg-gray-50  hover:bg-gray-800">
                    Categories
                </a>
                <a href="/about" class="text-gray-600 hover:text-indigo-600  text-gray-300  hover:text-indigo-400 transition-all duration-200 font-medium py-2 px-4 rounded-lg hover:bg-gray-50  hover:bg-gray-800">
                    About
                </a>
                <a href="/contact" class="text-gray-600 hover:text-indigo-600  text-gray-300  hover:text-indigo-400 transition-all duration-200 font-medium py-2 px-4 rounded-lg hover:bg-gray-50  hover:bg-gray-800">
                    Contact
                </a>
            </div>
        </div>
    </div>
</nav>
