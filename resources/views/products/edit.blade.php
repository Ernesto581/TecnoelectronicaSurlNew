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

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Nombre <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('name') border-red-300 @enderror"
                           required maxlength="255" />
                    @error('name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-semibold text-gray-900 mb-2">Categoria</label>
                    <select name="category_id" id="category_id"
                            class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('category_id') border-red-300 @enderror">
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

                <!-- SKU -->
                <div>
                    <label for="sku" class="block text-sm font-semibold text-gray-900 mb-2">SKU</label>
                    <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('sku') border-red-300 @enderror"
                           maxlength="100" />
                    @error('sku')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-900 mb-2">Precio <span class="text-red-500">*</span></label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" min="0"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('price') border-red-300 @enderror"
                           required />
                    @if ($product->original_price !== null)
                        <p class="text-xs text-gray-400 mt-1.5">
                            Precio de referencia: <span class="font-semibold text-gray-500">${{ number_format($product->original_price, 2) }}</span>
                            @if ($product->original_price > $product->price)
                                &mdash; descuento actual del {{ $product->discount_percentage }}%
                            @endif
                        </p>
                        <div class="mt-6 pt-5 border-t border-gray-100">
                            <label for="discount_percentage" class="block text-sm font-semibold text-gray-900 mb-3">
                                Aplicar descuento sobre el precio de referencia
                            </label>
                            <div class="flex items-center gap-5">
                                <div class="relative w-[140px]">
                                    <input type="number"
                                           name="discount_percentage"
                                           id="discount_percentage"
                                           value="{{ old('discount_percentage') }}"
                                           step="0.01"
                                           min="0"
                                           max="100"
                                           placeholder="0"
                                            class="w-full rounded-2xl border border-gray-200 pl-4 pr-10 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('discount_percentage') border-red-300 @enderror" />
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-sm font-medium text-gray-400">%</span>
                                </div>
                                <div class="flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl">
                                    <span class="text-sm text-gray-500">Precio final</span>
                                    <span id="discount-preview" class="text-sm font-bold text-[#046b22]">${{ number_format($product->price, 2) }}</span>
                                </div>
                            </div>
                            <p class="text-xs text-gray-400 mt-2">Deja vacío para no aplicar descuento.</p>
                            @error('discount_percentage')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @else
                        <p class="text-xs text-gray-400 mt-1">
                            El precio de referencia se establecerá automáticamente tras 30 días sin cambios.
                            @if ($product->price_changed_at)
                                · Último cambio: {{ $product->price_changed_at->diffForHumans() }}
                            @endif
                        </p>
                    @endif
                    @error('price')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-sm font-semibold text-gray-900 mb-2">Stock <span class="text-red-500">*</span></label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" min="0"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('stock') border-red-300 @enderror"
                           required />
                    @error('stock')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-900 mb-2">Imagen</label>
                    @if ($product->image_url)
                        <div class="mb-3 flex items-center gap-3">
                            <img src="{{ Str::startsWith($product->image_url, 'http') ? $product->image_url : Storage::url($product->image_url) }}" alt="{{ $product->name }}"
                                 class="w-16 h-16 rounded-xl object-cover border border-gray-200" />
                            <span class="text-xs text-gray-400">Imagen actual</span>
                        </div>
                    @endif
                    <input type="file" name="image" id="image" accept="image/*"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#ecf8ef] file:text-[#46A040] hover:file:bg-[#d9f2da] @error('image') border-red-300 @enderror" />
                    <p class="text-xs text-gray-400 mt-1">Deja vacio para mantener la imagen actual.</p>
                    @error('image')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-semibold text-gray-900 mb-2">Descripcion</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('description') border-red-300 @enderror">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex items-center gap-6 border-t border-gray-100 pt-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="hidden" name="is_active" value="0" />
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active)) class="rounded border-gray-300 text-[#46A040] focus:ring-[#46A040]" />
                    <span class="text-sm font-medium text-gray-700">Activo</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="hidden" name="is_featured" value="0" />
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured)) class="rounded border-gray-300 text-[#46A040] focus:ring-[#46A040]" />
                    <span class="text-sm font-medium text-gray-700">Destacado</span>
                </label>
            </div>

            <div class="mt-8 flex items-center justify-end gap-4">
                <a href="{{ route('products.index') }}"
                   class="px-5 py-3 text-sm font-semibold text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition-colors">
                    Cancelar
                </a>
                <button type="submit"
                        class="px-6 py-3 text-sm font-semibold text-white bg-[#46A040] rounded-full hover:bg-[#3d8c38] transition-colors">
                    Guardar cambios
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>

@if ($product->original_price !== null)
@push('scripts')
<script>
    const priceInput = document.getElementById('price');
    const discountInput = document.getElementById('discount_percentage');
    const preview = document.getElementById('discount-preview');
    const originalPrice = {{ $product->original_price }};

    function updateDiscountPreview() {
        const pct = parseFloat(discountInput.value) || 0;
        const discounted = originalPrice * (1 - pct / 100);
        preview.textContent = '$' + discounted.toFixed(2);
    }

    discountInput.addEventListener('input', function() {
        updateDiscountPreview();
        if (this.value) {
            const pct = parseFloat(this.value) || 0;
            const discounted = originalPrice * (1 - pct / 100);
            priceInput.value = discounted.toFixed(2);
        }
    });

    priceInput.addEventListener('input', function() {
        discountInput.value = '';
        const pct = ((originalPrice - parseFloat(this.value || originalPrice)) / originalPrice * 100);
        preview.textContent = '$' + (parseFloat(this.value) || originalPrice).toFixed(2);
    });
</script>
@endpush
@endif

@endsection
