@props(['product', 'userReview' => null])

@php
    $avg = $product->rating ?? 0;
    $count = $product->reviews_count ?? 0;
    $currentRating = old('rating', $userReview->rating ?? 0);
@endphp

<div class="space-y-4">
    <!-- User rating form -->
    @auth
    <form action="{{ route('store.product.review', $product) }}" method="POST" class="space-y-3">
        @csrf

        <div class="flex items-center gap-2">
            <span class="text-sm text-gray-500">Tu puntuación:</span>
            <div class="flex items-center gap-1">
                @for ($i = 1; $i <= 5; $i++)
                    <label class="cursor-pointer">
                        <input type="radio" name="rating" value="{{ $i }}" class="sr-only"
                               {{ $currentRating == $i ? 'checked' : '' }}
                               onchange="this.form.submit()" />
                        <x-icon name="star"
                                class="w-6 h-6 transition-colors {{ $i <= $currentRating ? 'fill-yellow-400 text-yellow-400' : 'text-gray-300 hover:text-yellow-300' }}" />
                    </label>
                @endfor
            </div>
        </div>

        @if ($currentRating > 0)
            <div>
                <textarea name="comment" rows="2" placeholder="Cuéntanos tu experiencia con este producto..."
                          class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] resize-none">{{ old('comment', $userReview->comment ?? '') }}</textarea>
            </div>
            <button type="submit"
                    class="px-4 py-2 text-sm font-semibold text-white bg-[#46A040] rounded-xl hover:bg-[#3d8c38] transition-colors">
                Enviar reseña
            </button>
        @endif
    </form>
    @endauth
</div>
