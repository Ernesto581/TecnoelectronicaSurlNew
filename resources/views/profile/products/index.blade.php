@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[1600px] mx-auto px-4 md:px-8 py-10">
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Productos</h1>
                <p class="text-gray-600 mt-1">{{ $products->total() }} productos registrados</p>
            </div>
            <a href="{{ route('profile.products.create') }}"
               class="inline-flex items-center gap-2 px-5 py-3 text-sm font-semibold text-white bg-[#46A040] rounded-full hover:bg-[#3d8c38] transition-colors">
                <x-icon name="plus" class="w-4 h-4" />
                Nuevo producto
            </a>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-sm font-medium text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <section class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm text-gray-700">
                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-50">
                            <th class="py-4 px-6 font-semibold text-gray-900">Producto</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Precio</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Stock</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Categoria</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Etiqueta</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Estado</th>
                            <th class="py-4 px-6 font-semibold text-gray-900 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        @if ($product->image_url)
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                                 class="w-10 h-10 rounded-lg object-cover border border-gray-200" />
                                        @else
                                            <div class="w-10 h-10 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center">
                                                <x-icon name="package" class="w-5 h-5 text-gray-400" />
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $product->name }}</p>
                                            <p class="text-xs text-gray-400">{{ $product->slug }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-semibold text-[#046b22]">${{ number_format($product->price, 2) }}</span>
                                    @if ($product->original_price && $product->original_price > $product->price)
                                        <span class="text-xs text-gray-400 line-through ml-2">${{ number_format($product->original_price, 2) }}</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <span class="@if ($product->stock <= 0) text-red-600 @elseif ($product->stock <= 5) text-amber-600 @else text-gray-700 @endif font-medium">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-gray-500">
                                    {{ $product->category?->name ?? 'Sin categoria' }}
                                </td>
                                <td class="py-4 px-6">
                                    @if ($product->badge)
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                            @switch($product->badge)
                                                @case(App\Enums\ProductBadge::New_)
                                                    bg-blue-50 text-blue-700
                                                    @break
                                                @case(App\Enums\ProductBadge::Offer)
                                                    bg-amber-50 text-amber-700
                                                    @break
                                                @case(App\Enums\ProductBadge::Featured)
                                                    bg-purple-50 text-purple-700
                                                    @break
                                                @case(App\Enums\ProductBadge::SoldOut)
                                                    bg-red-50 text-red-700
                                                    @break
                                                @default
                                                    bg-gray-50 text-gray-700
                                            @endswitch
                                        ">
                                            {{ $product->badge->value }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">&mdash;</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    @if ($product->trashed())
                                        <span class="inline-flex items-center rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">Eliminado</span>
                                    @elseif ($product->is_active)
                                        <span class="inline-flex items-center rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">Activo</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">Inactivo</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('profile.products.show', $product) }}"
                                           class="rounded-full p-2 text-gray-400 hover:text-[#46A040] hover:bg-gray-100 transition-colors"
                                           title="Ver detalle">
                                            <x-icon name="eye" class="w-4 h-4" />
                                        </a>
                                        @unless ($product->trashed())
                                            <a href="{{ route('profile.products.edit', $product) }}"
                                               class="rounded-full p-2 text-gray-400 hover:text-amber-600 hover:bg-gray-100 transition-colors"
                                               title="Editar">
                                                <x-icon name="edit" class="w-4 h-4" />
                                            </a>
                                            <form action="{{ route('profile.products.destroy', $product) }}" method="POST"
                                                  onsubmit="return confirm('Eliminar este producto?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="rounded-full p-2 text-gray-400 hover:text-red-600 hover:bg-gray-100 transition-colors"
                                                        title="Eliminar">
                                                    <x-icon name="trash" class="w-4 h-4" />
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('profile.products.restore', $product->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                        class="rounded-full px-3 py-1.5 text-xs font-semibold text-green-700 bg-green-50 hover:bg-green-100 transition-colors"
                                                        title="Restaurar">
                                                    Restaurar
                                                </button>
                                            </form>
                                        @endunless
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-16 text-center text-gray-400">
                                    <x-icon name="package" class="w-10 h-10 mx-auto mb-3 text-gray-300" />
                                    <p class="font-medium">No hay productos registrados</p>
                                    <p class="text-sm mt-1">Crea el primer producto para empezar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($products->hasPages())
                <div class="border-t border-gray-100 px-6 py-4">
                    {{ $products->links() }}
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
