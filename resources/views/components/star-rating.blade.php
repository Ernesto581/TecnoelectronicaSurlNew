@props(['product', 'userReview' => null])

@php
    $avg = $product->rating ?? 0;
    $count = $product->reviews_count ?? 0;
@endphp

<div class="space-y-4">
    <!-- Average display -->
    <div class="flex items-center gap-2">
        <div class="flex items-center gap-0.5">
            @for ($i = 1; $i <= 5; $i++)
                @if ($avg >= $i)
                    <x-icon name="star" class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                @else
                    <x-icon name="star-outline" class="w-5 h-5 text-gray-300" />
                @endif
            @endfor
        </div>
        <span class="text-sm font-bold text-gray-700">{{ number_format($avg, 1) }}</span>
        <span class="text-sm text-gray-400">({{ $count }} {{ $count === 1 ? 'reseña' : 'reseñas' }})</span>
    </div>

    <!-- User's review form -->
    @auth
    <form action="{{ route('store.product.review', $product) }}" method="POST" class="space-y-3">
        @csrf
        <div x-data="{ rating: {{ old('rating', $userReview->rating ?? 0) }}, hover: 0 }" class="space-y-3">
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500 mr-1">Tu puntuación:</span>
                <div class="flex items-center gap-0.5">
                    @for ($i = 1; $i <= 5; $i++)
                        <button type="submit" name="rating" value="{{ $i }}"
                                x-on:mouseenter="hover = {{ $i }}" x-on:mouseleave="hover = 0"
                                class="transition-colors">
                            <x-icon name="star"
                                    class="w-6 h-6 cursor-pointer transition-colors"
                                    x-bind:class="({{ $i }} <= (hover || rating)) ? 'fill-yellow-400 text-yellow-400' : 'text-gray-300'" />
                        </button>
                    @endfor
                </div>
            </div>
            <div x-show="rating > 0" x-transition>
                <textarea name="comment" rows="2" placeholder="Cuéntanos tu experiencia con este producto..."
                          class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] resize-none">{{ old('comment', $userReview->comment ?? '') }}</textarea>
            </div>
        </div>
    </form>
    @endauth
</div>
