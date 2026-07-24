@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[900px] mx-auto px-4 md:px-8 py-10">
        <div class="mb-8">
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#46A040] transition-colors mb-4">
                <x-icon name="chevron-left" class="w-4 h-4" />
                Volver a productos
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Nuevo producto</h1>
            <p class="text-gray-600 mt-1">Completa los datos para registrar un nuevo producto en el catalogo.</p>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Nombre <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
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
                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
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
                    <input type="text" name="sku" id="sku" value="{{ old('sku') }}"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('sku') border-red-300 @enderror"
                           maxlength="100" />
                    @error('sku')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-900 mb-2">Precio <span class="text-red-500">*</span></label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('price') border-red-300 @enderror"
                           required />
                    @error('price')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-sm font-semibold text-gray-900 mb-2">Stock <span class="text-red-500">*</span></label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" min="0"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('stock') border-red-300 @enderror"
                           required />
                    @error('stock')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-900 mb-2">Imagen</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#ecf8ef] file:text-[#46A040] hover:file:bg-[#d9f2da] @error('image') border-red-300 @enderror" />
                    @error('image')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-semibold text-gray-900 mb-2">Descripcion</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('description') border-red-300 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex items-center gap-6 border-t border-gray-100 pt-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="hidden" name="is_active" value="0" />
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', true)) class="rounded border-gray-300 text-[#46A040] focus:ring-[#46A040]" />
                    <span class="text-sm font-medium text-gray-700">Activo</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="hidden" name="is_featured" value="0" />
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', false)) class="rounded border-gray-300 text-[#46A040] focus:ring-[#46A040]" />
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
                    Crear producto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
