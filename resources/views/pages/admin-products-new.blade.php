@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[800px] mx-auto px-4 md:px-8 py-10">
        <div class="mb-8">
            <a href="/admin/products" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1 mb-6">
                <x-icon name="chevron-left" class="w-4 h-4" />
                Volver a productos
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Nuevo producto</h1>
            <p class="text-gray-600 mt-2">Agrega un nuevo producto al catálogo.</p>
        </div>

        <form action="/admin/products" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre del producto</label>
                    <input type="text" name="name" required value="{{ old('name') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm" placeholder="Ej: Refrigerador Samsung" />
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Categoría</label>
                    <select name="category_id" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm bg-white">
                        <option value="">Seleccionar...</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Badge / Etiqueta</label>
                    <input type="text" name="badge" value="{{ old('badge') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm" placeholder="Ej: Oferta, Nuevo, Destacado" />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Precio ($)</label>
                    <input type="number" name="price" required step="0.01" min="0" value="{{ old('price') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm" placeholder="0.00" />
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Precio original ($)</label>
                    <input type="number" name="original_price" step="0.01" min="0" value="{{ old('original_price') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm" placeholder="Para mostrar descuento" />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Stock <span class="text-gray-400 font-normal">(opcional)</span></label>
                    <input type="number" name="stock" min="0" value="{{ old('stock', '') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm" placeholder="Dejar en blanco = sin stock" />
                    @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Imagen del producto</label>
                    <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-[#46A040] file:text-white file:font-semibold file:text-sm hover:file:bg-[#3d8c38]" />
                    <p class="text-xs text-gray-400 mt-1">O usa una URL:</p>
                    <input type="url" name="image_url" value="{{ old('image_url') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm mt-2" placeholder="https://images.unsplash.com/photo-..." />
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    @error('image_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Descripción</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm resize-none" placeholder="Descripción del producto...">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-3 bg-[#46A040] text-white font-semibold rounded-xl hover:bg-[#3d8c38] transition-colors shadow-sm">Guardar producto</button>
                <a href="/admin/products" class="px-6 py-3 text-gray-600 font-medium rounded-xl hover:bg-gray-100 transition-colors">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection