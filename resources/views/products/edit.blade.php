@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[900px] mx-auto px-4 md:px-8 py-10">

        <div class="mb-8">
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#46A040] transition-colors mb-4">
                <x-icon name="chevron-left" class="w-4 h-4" />
                Volver a productos
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Editar producto</h1>
            <p class="text-gray-600 mt-1">Modifica los datos de <strong>{{ $product->name }}</strong>.</p>
        </div>

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data"
              x-data="{ imagePreview: '{{ $product->image_url ? (Str::startsWith($product->image_url, 'http') ? $product->image_url : Storage::url($product->image_url)) : '' }}', imageName: '' }"
              class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 md:p-8">
            @csrf
            @method('PATCH')

            <div class="flex flex-col md:flex-row gap-6 md:gap-10">
                <!-- Image sidebar -->
                <div class="flex flex-col items-center gap-3 shrink-0">
                    <label for="image"
                           class="relative w-36 h-36 rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 overflow-hidden cursor-pointer hover:border-[#46A040] transition-colors group flex items-center justify-center">
                        <template x-if="imagePreview">
                            <img :src="imagePreview" alt="{{ $product->name }}" class="w-full h-full object-cover" />
                        </template>
                        <template x-if="!imagePreview">
                            <div class="flex flex-col items-center gap-1 text-gray-400 group-hover:text-[#46A040] transition-colors">
                                <x-icon name="image" class="w-8 h-8" />
                                <span class="text-[11px] font-medium">Sin imagen</span>
                            </div>
                        </template>
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-white text-xs font-semibold">Cambiar</span>
                        </div>
                    </label>
                    <input type="file" name="image" id="image" accept="image/*"
                           x-on:change="imagePreview = URL.createObjectURL($event.target.files[0]); imageName = $event.target.files[0].name"
                           class="hidden" />
                    <p x-show="imageName" x-text="imageName" class="text-xs text-gray-400 text-center truncate max-w-[140px]"></p>
                    @error('image')
                        <p class="text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fields column -->
                <div class="flex-1 space-y-5">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-900 mb-1.5">Nombre <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                               class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('name') border-red-300 @enderror"
                               required maxlength="255" />
                        @error('name')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category + SKU row -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-gray-900 mb-1.5">Categoria</label>
                            <select name="category_id" id="category_id"
                                    class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('category_id') border-red-300 @enderror">
                                <option value="">Sin categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="sku" class="block text-sm font-semibold text-gray-900 mb-1.5">SKU</label>
                            <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}"
                                   class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('sku') border-red-300 @enderror"
                                   maxlength="100" />
                            @error('sku')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Price + Stock row -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="price" class="block text-sm font-semibold text-gray-900 mb-1.5">Precio <span class="text-red-500">*</span></label>
                            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" min="0"
                                   class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('price') border-red-300 @enderror"
                                   required />
                            @error('price')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="stock" class="block text-sm font-semibold text-gray-900 mb-1.5">Stock <span class="text-red-500">*</span></label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" min="0"
                                   class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('stock') border-red-300 @enderror"
                                   required />
                            @error('stock')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Discount (only if original_price is set) -->
                    @if ($product->original_price !== null)
                        <div class="bg-gray-50 rounded-xl p-4">
                            <div class="flex items-center justify-between gap-4 flex-wrap">
                                <div class="flex items-center gap-3">
                                    <span class="text-sm font-medium text-gray-700">Descuento</span>
                                    <div class="relative w-[100px]">
                                        <input type="number"
                                               name="discount_percentage"
                                               id="discount_percentage"
                                               value="{{ old('discount_percentage') }}"
                                               step="0.01" min="0" max="100" placeholder="0"
                                               class="w-full rounded-lg border border-gray-200 pl-3 pr-8 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040]" />
                                        <span class="absolute right-2.5 top-1/2 -translate-y-1/2 text-sm text-gray-400">%</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 text-sm">
                                    <span class="text-gray-400">Ref:</span>
                                    <span class="font-medium text-gray-500">${{ number_format($product->original_price, 2) }}</span>
                                    <span class="text-gray-300">&rarr;</span>
                                    <span id="discount-preview" class="font-bold text-[#046b22]">${{ number_format($product->price, 2) }}</span>
                                </div>
                            </div>
                            @error('discount_percentage')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @else
                        <p class="text-xs text-gray-400">
                            Precio de referencia se establecerá tras 30 días sin cambios
                            @if ($product->price_changed_at)
                                &middot; Último cambio: {{ $product->price_changed_at->diffForHumans() }}
                            @endif
                        </p>
                    @endif

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-900 mb-1.5">Descripcion</label>
                        <textarea name="description" id="description" rows="3"
                                  class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('description') border-red-300 @enderror">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Toggles + actions -->
                    <div class="flex items-center justify-between pt-3">
                        <div class="flex items-center gap-5">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="hidden" name="is_active" value="0" />
                                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active)) class="rounded border-gray-300 text-[#46A040] focus:ring-[#46A040]" />
                                <span class="text-sm text-gray-700">Activo</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="hidden" name="is_featured" value="0" />
                                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured)) class="rounded border-gray-300 text-[#46A040] focus:ring-[#46A040]" />
                                <span class="text-sm text-gray-700">Destacado</span>
                            </label>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('products.index') }}"
                               class="px-4 py-2 text-sm font-semibold text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition-colors">
                                Cancelar
                            </a>
                            <button type="submit"
                                    class="px-5 py-2 text-sm font-semibold text-white bg-[#46A040] rounded-full hover:bg-[#3d8c38] transition-colors">
                                Guardar cambios
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@if ($product->original_price !== null)
@push('scripts')
<script>
    const priceInput = document.getElementById('price');
    const discountInput = document.getElementById('discount_percentage');
    const preview = document.getElementById('discount-preview');
    const originalPrice = {{ $product->original_price }};

    discountInput.addEventListener('input', function() {
        const pct = parseFloat(this.value) || 0;
        const discounted = originalPrice * (1 - pct / 100);
        preview.textContent = '$' + discounted.toFixed(2);
        if (this.value) {
            priceInput.value = discounted.toFixed(2);
        }
    });

    priceInput.addEventListener('input', function() {
        discountInput.value = '';
        preview.textContent = '$' + (parseFloat(this.value) || originalPrice).toFixed(2);
    });
</script>
@endpush
@endif

@endsection
