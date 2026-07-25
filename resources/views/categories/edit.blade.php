@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[700px] mx-auto px-4 md:px-8 py-10">
        <div class="mb-8">
            <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#46A040] transition-colors mb-4">
                <x-icon name="chevron-left" class="w-4 h-4" />
                Volver a categorías
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Editar categoría</h1>
            <p class="text-gray-600 mt-1">Modifica los datos de <strong>{{ $category->name }}</strong>.</p>
        </div>

        <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
            @csrf
            @method('PATCH')

            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Nombre <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('name') border-red-300 @enderror"
                           required maxlength="255" />
                    <p class="text-xs text-gray-400 mt-1">El slug se regenerará si cambias el nombre.</p>
                    @error('name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-900 mb-2">Descripción</label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('description') border-red-300 @enderror">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-900 mb-2">Imagen</label>
                    @if ($category->image_url)
                        <div class="mb-3 flex items-center gap-3">
                            <img src="{{ Str::startsWith($category->image_url, 'http') ? $category->image_url : Storage::url($category->image_url) }}" alt="{{ $category->name }}"
                                 class="w-16 h-16 rounded-xl object-cover border border-gray-200" />
                            <span class="text-xs text-gray-400">Imagen actual</span>
                        </div>
                    @endif
                    <input type="file" name="image" id="image" accept="image/*"
                           class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#ecf8ef] file:text-[#46A040] hover:file:bg-[#d9f2da] @error('image') border-red-300 @enderror" />
                    <p class="text-xs text-gray-400 mt-1">Deja vacío para mantener la imagen actual.</p>
                    @error('image')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex items-center gap-6 border-t border-gray-100 pt-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="hidden" name="is_active" value="0" />
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active)) class="rounded border-gray-300 text-[#46A040] focus:ring-[#46A040]" />
                    <span class="text-sm font-medium text-gray-700">Activa</span>
                </label>
            </div>

            <div class="mt-8 flex items-center justify-end gap-4">
                <a href="{{ route('categories.index') }}"
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
