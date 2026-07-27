@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[1600px] mx-auto px-4 md:px-8 py-10">
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#46A040] transition-colors mb-2">
                    <x-icon name="chevron-left" class="w-4 h-4" />
                    Volver al perfil
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Productos</h1>
                <div class="flex flex-wrap items-center gap-2 mt-2">
                    <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-semibold text-green-700">{{ $totalActive }} activos</span>
                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-semibold text-gray-600">{{ $totalInactive }} inactivos</span>
                    @if ($lowStock > 0)
                        <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-semibold text-amber-700">{{ $lowStock }} stock bajo</span>
                    @endif
                </div>
            </div>
            <a href="{{ route('products.create') }}"
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

        @if (session('error'))
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-6 py-4 text-sm font-medium text-red-800">
                {{ session('error') }}
            </div>
        @endif

        <!-- Filter bar -->
        <form method="GET" action="{{ route('products.index') }}" class="mb-6 bg-white rounded-2xl border border-gray-200 shadow-sm p-4">
            <div class="flex flex-wrap items-end gap-3">
                <!-- Search -->
                <div class="flex-1 min-w-[200px]">
                    <label for="search" class="block text-xs font-semibold text-gray-500 mb-1">Buscar</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                           placeholder="Nombre, SKU, descripción..."
                           class="w-full px-4 py-2 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none" />
                </div>

                <!-- Category -->
                <div class="w-40">
                    <label for="category" class="block text-xs font-semibold text-gray-500 mb-1">Categoría</label>
                    <select id="category" name="category"
                            class="w-full py-2 px-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none">
                        <option value="">Todas</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status -->
                <div class="w-36">
                    <label for="status" class="block text-xs font-semibold text-gray-500 mb-1">Estado</label>
                    <select id="status" name="status"
                            class="w-full py-2 px-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none">
                        <option value="active" {{ request('status', 'active') === 'active' ? 'selected' : '' }}>Activos</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactivos</option>
                    </select>
                </div>

                <!-- Price range -->
                <div class="flex items-end gap-2">
                    <div class="w-28">
                        <label for="price_min" class="block text-xs font-semibold text-gray-500 mb-1">Precio min</label>
                        <input type="number" id="price_min" name="price_min" value="{{ request('price_min') }}" step="0.01" min="0"
                               placeholder="0.00"
                               class="w-full py-2 px-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none" />
                    </div>
                    <span class="pb-2 text-gray-400 text-sm">&ndash;</span>
                    <div class="w-28">
                        <label for="price_max" class="block text-xs font-semibold text-gray-500 mb-1">Precio max</label>
                        <input type="number" id="price_max" name="price_max" value="{{ request('price_max') }}" step="0.01" min="0"
                               placeholder="0.00"
                               class="w-full py-2 px-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none" />
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-end gap-2">
                    <button type="submit"
                            class="px-4 py-2 text-sm font-semibold text-white bg-[#46A040] rounded-xl hover:bg-[#3d8c38] transition-colors">
                        Filtrar
                    </button>
                    @if (request()->hasAny(['search', 'category', 'status', 'price_min', 'price_max']) && request('status') !== 'active')
                        <a href="{{ route('products.index') }}"
                           class="px-4 py-2 text-sm font-semibold text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">
                            Limpiar
                        </a>
                    @endif
                </div>
            </div>
        </form>

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
                                            <img src="{{ Str::startsWith($product->image_url, 'http') ? $product->image_url : Storage::url($product->image_url) }}" alt="{{ $product->name }}"
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
                                    @if ($product->is_active)
                                        <span class="inline-flex items-center rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">Activo</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">Inactivo</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('products.show', $product) }}"
                                           class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 hover:text-gray-800 transition-colors">
                                            <x-icon name="eye" class="w-3.5 h-3.5" />
                                            Ver
                                        </a>
                                        <a href="{{ route('products.edit', $product) }}"
                                           class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold text-amber-700 bg-amber-50 hover:bg-amber-100 transition-colors">
                                            <x-icon name="edit" class="w-3.5 h-3.5" />
                                            Editar
                                        </a>
                                        @if ($product->is_active)
                                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                  onsubmit="return confirm('¿Inactivar este producto?')" class="inline-flex">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold text-red-700 bg-red-50 hover:bg-red-100 transition-colors">
                                                    <x-icon name="trash" class="w-3.5 h-3.5" />
                                                    Inactivar
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('products.activate', $product) }}" method="POST" class="inline-flex">
                                                @csrf
                                                <button type="submit"
                                                        class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold text-green-700 bg-green-50 hover:bg-green-100 transition-colors">
                                                    <x-icon name="check-circle" class="w-3.5 h-3.5" />
                                                    Activar
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-16 text-center text-gray-400">
                                    <x-icon name="package" class="w-10 h-10 mx-auto mb-3 text-gray-300" />
                                    @if (request()->hasAny(['search', 'category', 'status', 'price_min', 'price_max']) && request('status') !== 'active')
                                        <p class="font-medium">Sin resultados</p>
                                        <p class="text-sm mt-1">No se encontraron productos con los filtros seleccionados.</p>
                                    @else
                                        <p class="font-medium">No hay productos registrados</p>
                                        <p class="text-sm mt-1">Crea el primer producto para empezar.</p>
                                    @endif
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
