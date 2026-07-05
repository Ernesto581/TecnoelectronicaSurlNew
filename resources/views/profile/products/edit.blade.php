@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[900px] mx-auto px-4 md:px-8 py-10">
        <div class="mb-8">
            <a href="{{ route('profile.products.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#46A040] transition-colors mb-4">
                <x-icon name="chevron-left" class="w-4 h-4" />
                Volver a productos
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Editar producto</h1>
            <p class="text-gray-600 mt-1">{{ $product->name }}</p>
        </div>

        <form action="{{ route('profile.products.update', $product) }}" method="POST" class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Nombre <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('name') border-red-300 @enderror"
                           required maxlength="255" />
                    @error('name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="slug" class="block text-sm font-semibold text-gray-900 mb-2">Slug <span class="text-red-500">*</span></label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $product->slug) }}"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('slug') border-red-300 @enderror"
                           required maxlength="255" />
                    @error('slug')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="sku" class="block text-sm font-semibold text-gray-900 mb-2">SKU</label>
                    <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('sku') border-red-300 @enderror"
                           maxlength="100" />
                    @error('sku')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

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

                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-900 mb-2">Precio <span class="text-red-500">*</span></label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" min="0"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('price') border-red-300 @enderror"
                           required />
                    @error('price')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="original_price" class="block text-sm font-semibold text-gray-900 mb-2">Precio original</label>
                    <input type="number" name="original_price" id="original_price" value="{{ old('original_price', $product->original_price) }}" step="0.01" min="0"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('original_price') border-red-300 @enderror" />
                    @error('original_price')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="block text-sm font-semibold text-gray-900 mb-2">Stock <span class="text-red-500">*</span></label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" min="0"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('stock') border-red-300 @enderror"
                           required />
                    @error('stock')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="badge" class="block text-sm font-semibold text-gray-900 mb-2">Etiqueta</label>
                    <select name="badge" id="badge"
                            class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('badge') border-red-300 @enderror">
                        <option value="">Sin etiqueta</option>
                        @foreach (App\Enums\ProductBadge::cases() as $badge)
                            <option value="{{ $badge->value }}" @selected(old('badge', $product->badge?->value) == $badge->value)>
                                {{ $badge->value }}
                            </option>
                        @endforeach
                    </select>
                    @error('badge')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rating" class="block text-sm font-semibold text-gray-900 mb-2">Valoracion</label>
                    <input type="number" name="rating" id="rating" value="{{ old('rating', $product->rating) }}" step="0.1" min="0" max="5"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('rating') border-red-300 @enderror" />
                    @error('rating')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="reviews_count" class="block text-sm font-semibold text-gray-900 mb-2">Numero de reseñas</label>
                    <input type="number" name="reviews_count" id="reviews_count" value="{{ old('reviews_count', $product->reviews_count) }}" min="0"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('reviews_count') border-red-300 @enderror" />
                    @error('reviews_count')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image_url" class="block text-sm font-semibold text-gray-900 mb-2">URL de imagen</label>
                    <input type="url" name="image_url" id="image_url" value="{{ old('image_url', $product->image_url) }}"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('image_url') border-red-300 @enderror"
                           maxlength="2048" />
                    @error('image_url')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

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
                <a href="{{ route('profile.products.index') }}"
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
@endsection
