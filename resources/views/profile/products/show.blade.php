@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[1200px] mx-auto px-4 md:px-8 py-10">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('profile.products.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#46A040] transition-colors">
                <x-icon name="chevron-left" class="w-4 h-4" />
                Volver a productos
            </a>
            <div class="flex items-center gap-3">
                @unless ($product->trashed())
                    <a href="{{ route('profile.products.edit', $product) }}"
                       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-amber-700 bg-amber-50 rounded-full hover:bg-amber-100 transition-colors">
                        <x-icon name="edit" class="w-4 h-4" />
                        Editar
                    </a>
                @endunless
                @unless ($product->trashed())
                    <form action="{{ route('profile.products.destroy', $product) }}" method="POST"
                          onsubmit="return confirm('Eliminar este producto?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-red-700 bg-red-50 rounded-full hover:bg-red-100 transition-colors">
                            <x-icon name="trash" class="w-4 h-4" />
                            Eliminar
                        </button>
                    </form>
                @else
                    <form action="{{ route('profile.products.restore', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-green-700 bg-green-50 rounded-full hover:bg-green-100 transition-colors">
                            <x-icon name="refresh-cw" class="w-4 h-4" />
                            Restaurar
                        </button>
                    </form>
                @endunless
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="relative aspect-square rounded-2xl overflow-hidden bg-white border border-gray-200 shadow-sm">
                @if ($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-50">
                        <x-icon name="package" class="w-20 h-20 text-gray-300" />
                    </div>
                @endif
                @if ($product->badge)
                    <div class="absolute top-4 left-4 z-10 bg-[#46A040] text-white text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-full shadow-md">
                        {{ $product->badge->value }}
                    </div>
                @endif
            </div>

            <div class="flex flex-col gap-6">
                <div>
                    @if ($product->category)
                        <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">{{ $product->category->name }}</div>
                    @endif
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">{{ $product->name }}</h1>
                </div>

                <div class="flex items-baseline gap-3">
                    <span class="text-3xl font-bold text-[#046b22]">${{ number_format($product->price, 2) }}</span>
                    @if ($product->original_price && $product->original_price > $product->price)
                        <span class="text-lg text-gray-400 line-through">${{ number_format($product->original_price, 2) }}</span>
                        <span class="text-sm font-semibold text-red-600">-{{ $product->discount_percentage }}%</span>
                    @endif
                </div>

                @if ($product->description)
                    <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                @endif

                <div class="grid grid-cols-2 gap-4">
                    <div class="rounded-2xl border border-gray-100 bg-gray-50 p-4">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">SKU</p>
                        <p class="text-sm font-medium text-gray-900 mt-1">{{ $product->sku ?? 'N/A' }}</p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-gray-50 p-4">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Stock</p>
                        <p class="text-sm font-medium mt-1 @if ($product->stock <= 0) text-red-600 @elseif ($product->stock <= 5) text-amber-600 @else text-gray-900 @endif">
                            {{ $product->stock }} {{ $product->stock === 1 ? 'unidad' : 'unidades' }}
                        </p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-gray-50 p-4">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Valoracion</p>
                        <p class="text-sm font-medium text-gray-900 mt-1">
                            {{ number_format($product->rating, 1) }} ({{ $product->reviews_count }} reseñas)
                        </p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-gray-50 p-4">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Estado</p>
                        <p class="text-sm font-medium mt-1">
                            @if ($product->trashed())
                                <span class="text-red-600">Eliminado</span>
                            @elseif ($product->is_active)
                                <span class="text-green-600">Activo</span>
                            @else
                                <span class="text-gray-500">Inactivo</span>
                            @endif
                            @if ($product->is_featured)
                                <span class="text-purple-600 ml-2">· Destacado</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="mt-4 text-xs text-gray-400">
                    Creado {{ $product->created_at->format('d/m/Y') }}
                    @if ($product->updated_at->gt($product->created_at))
                        &middot; Actualizado {{ $product->updated_at->format('d/m/Y') }}
                    @endif
                    @if ($product->trashed())
                        &middot; Eliminado {{ $product->deleted_at->format('d/m/Y') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
