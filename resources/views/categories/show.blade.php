@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[900px] mx-auto px-4 md:px-8 py-10">

        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#46A040] transition-colors">
                <x-icon name="chevron-left" class="w-4 h-4" />
                Volver a categorías
            </a>
            <div class="flex items-center gap-3">
                @unless ($category->trashed())
                    <a href="{{ route('categories.edit', $category) }}"
                       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-amber-700 bg-amber-50 rounded-full hover:bg-amber-100 transition-colors">
                        <x-icon name="edit" class="w-4 h-4" />
                        Editar
                    </a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                          onsubmit="return confirm('¿Eliminar esta categoría?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-red-700 bg-red-50 rounded-full hover:bg-red-100 transition-colors">
                            <x-icon name="trash" class="w-4 h-4" />
                            Eliminar
                        </button>
                    </form>
                @else
                    <form action="{{ route('categories.restore', $category) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-green-700 bg-green-50 rounded-full hover:bg-green-100 transition-colors">
                            Restaurar
                        </button>
                    </form>
                @endunless
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 md:p-8">
            <div class="flex flex-col md:flex-row gap-6 mb-8">
                @if ($category->image_url)
                    <img src="{{ Str::startsWith($category->image_url, 'http') ? $category->image_url : Storage::url($category->image_url) }}" alt="{{ $category->name }}"
                         class="w-full md:w-48 h-48 rounded-2xl object-cover border border-gray-200" />
                @else
                    <div class="w-full md:w-48 h-48 rounded-2xl bg-gray-50 border border-gray-200 flex items-center justify-center">
                        <x-icon name="shopping-basket" class="w-12 h-12 text-gray-300" />
                    </div>
                @endif
                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $category->name }}</h1>
                    <p class="text-sm text-gray-400 mt-1">{{ $category->slug }}</p>
                    <p class="text-sm text-gray-500 mt-1">{{ $category->products_count }} productos</p>
                    @if ($category->description)
                        <p class="text-gray-600 mt-4 leading-relaxed">{{ $category->description }}</p>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-gray-50 rounded-xl p-4 text-center">
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Estado</p>
                    <p class="font-semibold text-sm {{ $category->is_active ? 'text-green-600' : 'text-gray-500' }}">
                        {{ $category->is_active ? 'Activa' : 'Inactiva' }}
                    </p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 text-center">
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Productos</p>
                    <p class="font-semibold text-sm text-gray-700">{{ $category->products_count }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 text-center">
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Creada</p>
                    <p class="font-semibold text-sm text-gray-700">{{ $category->created_at->isoFormat('LL') }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 text-center">
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Actualizada</p>
                    <p class="font-semibold text-sm text-gray-700">{{ $category->updated_at->isoFormat('LL') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
