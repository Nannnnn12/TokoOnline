<!-- Customer Reviews Section -->
@if ($totalReviewsCount > 0)
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Ulasan Pelanggan</h2>
                    <p class="text-gray-600">{{ $totalReviewsCount }} ulasan</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="flex text-yellow-400">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= round($product->reviews_avg_rating ?? 0))
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 fill-gray-300" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <span
                            class="text-lg font-semibold text-gray-900 ml-2">{{ number_format($product->reviews_avg_rating ?? 0, 1) }}</span>
                    </div>

                    <!-- Sort Buttons -->
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-2">
                        <span class="text-sm text-gray-600">Filter:</span>
                        <div class="flex flex-wrap gap-1 sm:gap-1">
                            <a href="{{ route('products.show', $product) }}?sort=all"
                                class="filter-btn px-2 sm:px-3 py-1 text-xs rounded-full {{ $sortBy == 'all' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-colors"
                                data-sort="all">
                                Semua
                            </a>
                            @for ($i = 5; $i >= 1; $i--)
                                <a href="{{ route('products.show', $product) }}?sort=rating_{{ $i }}"
                                    class="filter-btn px-2 sm:px-3 py-1 text-xs rounded-full {{ $sortBy == 'rating_' . $i ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-colors flex items-center space-x-1"
                                    data-sort="rating_{{ $i }}">
                                    <span>{{ $i }}</span>
                                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </a>
                            @endfor
                            <a href="{{ route('products.show', $product) }}?sort=date_desc"
                                class="filter-btn px-2 sm:px-3 py-1 text-xs rounded-full {{ $sortBy == 'date_desc' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-colors"
                                data-sort="date_desc">
                                Terbaru
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                @if ($product->reviews->count() > 0)
                    @foreach ($product->reviews as $review)
                        <div class="border-b border-gray-100 pb-6 last:border-b-0 last:pb-0">
                            <div class="flex items-start space-x-4">
                                <!-- User Avatar -->
                                <div
                                    class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span
                                        class="text-white font-semibold text-lg">{{ substr($review->user->name, 0, 1) }}</span>
                                </div>

                                <!-- Review Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center space-x-3">
                                            <h4 class="text-lg font-semibold text-gray-900">
                                                {{ $review->user->name }}
                                                @if ($review->user_id == auth()->id())
                                                    <span class="text-sm font-normal text-gray-500">(you)</span>
                                                @endif
                                            </h4>
                                            <div class="flex text-yellow-400">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review->rating)
                                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-4 h-4 fill-gray-300" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <span
                                            class="text-sm text-gray-500">{{ $review->created_at->format('d M Y') }}</span>
                                    </div>

                                    @if ($review->comment)
                                        <p class="text-gray-700 leading-relaxed mb-4">{{ $review->comment }}</p>
                                    @endif

                                    @if ($review->image)
                                        <div class="mt-4">
                                            <img src="{{ $review->image_url }}" alt="Review image"
                                                class="max-w-xs h-auto rounded-lg shadow-md">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada ulasan dengan filter ini</h3>
                        <p class="text-gray-600">Coba pilih filter lain atau lihat semua ulasan.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
