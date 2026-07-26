@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28 pb-16">
    <div class="max-w-[900px] mx-auto px-4 md:px-8 py-10">

        <div class="mb-8">
            <a href="{{ route('store.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#46A040] transition-colors mb-2">
                <x-icon name="chevron-left" class="w-4 h-4" />
                Volver a la tienda
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Carrito</h1>
            <p class="text-gray-600 mt-1">
                @if ($cart && $cart->items->isNotEmpty())
                    {{ $cart->items->count() }} {{ $cart->items->count() === 1 ? 'producto' : 'productos' }}
                @else
                    Sin productos
                @endif
            </p>
        </div>

        @if (session('cart_error'))
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-6 py-4 text-sm font-medium text-red-800">{{ session('cart_error') }}</div>
        @endif
        @if (session('cart_success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-sm font-medium text-green-800">{{ session('cart_success') }}</div>
        @endif

        @if ($cart && $cart->items->isNotEmpty())
            <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="divide-y divide-gray-100">
                    @foreach ($cart->items as $item)
                        <div class="flex items-center gap-4 p-5">
                            <a href="{{ route('store.product.show', $item->product) }}" class="shrink-0">
                                @if ($item->product->image_url)
                                    <img src="{{ Str::startsWith($item->product->image_url, 'http') ? $item->product->image_url : Storage::url($item->product->image_url) }}"
                                         alt="{{ $item->product->name }}" class="w-20 h-20 rounded-xl object-cover border border-gray-200" />
                                @else
                                    <div class="w-20 h-20 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center">
                                        <x-icon name="package" class="w-8 h-8 text-gray-300" />
                                    </div>
                                @endif
                            </a>

                            <div class="flex-1 min-w-0">
                                <a href="{{ route('store.product.show', $item->product) }}"
                                   class="font-semibold text-gray-900 hover:text-[#46A040] transition-colors text-sm">
                                    {{ $item->product->name }}
                                </a>
                                <p class="text-sm font-bold text-[#046b22] mt-1">${{ number_format($item->unit_price, 2) }}</p>
                                @if ($item->quantity > $item->product->stock)
                                    <p class="text-xs text-red-500 mt-1">Solo quedan {{ $item->product->stock }} disponibles</p>
                                @endif
                            </div>

                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ max($item->product->stock, 1) }}"
                                       class="w-16 text-center py-2 text-sm font-semibold rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none" />
                                <button type="submit" class="text-xs text-[#46A040] font-semibold hover:underline whitespace-nowrap">Actualizar</button>
                            </form>

                            <span class="text-sm font-bold text-gray-900 w-20 text-right">${{ number_format($item->subtotal, 2) }}</span>

                            <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-1">
                                    <x-icon name="x" class="w-5 h-5" />
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-100 bg-gray-50 px-5 py-4 flex items-center justify-between">
                    <span class="text-sm text-gray-500">Total</span>
                    <span class="text-xl font-bold text-gray-900">${{ number_format($cart->total, 2) }}</span>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <a href="{{ route('store.index') }}" class="text-sm text-gray-500 hover:text-[#46A040] transition-colors">
                    &larr; Seguir comprando
                </a>
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="px-8 py-3 text-sm font-bold text-white bg-[#46A040] rounded-full hover:bg-[#3d8c38] transition-colors shadow-md shadow-[#46A040]/20">
                        Confirmar pedido
                    </button>
                </form>
            </div>
        @else
            <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-10 md:p-16 text-center">
                <div class="w-24 h-24 rounded-full bg-gray-50 flex items-center justify-center mx-auto mb-6">
                    <x-icon name="shopping-cart" class="w-10 h-10 text-gray-300" />
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Tu carrito está vacío</h2>
                <p class="text-gray-500 max-w-sm mx-auto mb-8">Aún no has añadido productos. Explora nuestro catálogo y encuentra lo que necesitas.</p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-lg mx-auto mb-8">
                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <x-icon name="package" class="w-6 h-6 text-[#46A040] mx-auto mb-2" />
                        <p class="text-xs text-gray-500">Variedad de productos</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <x-icon name="truck" class="w-6 h-6 text-[#46A040] mx-auto mb-2" />
                        <p class="text-xs text-gray-500">Envío a domicilio</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <x-icon name="shield-check" class="w-6 h-6 text-[#46A040] mx-auto mb-2" />
                        <p class="text-xs text-gray-500">Compra segura</p>
                    </div>
                </div>

                <a href="{{ route('store.index') }}"
                   class="inline-flex px-8 py-3.5 bg-[#46A040] text-white font-bold rounded-full hover:bg-[#3d8c38] transition-colors shadow-md shadow-[#46A040]/20">
                    Explorar tienda
                </a>
            </div>
        @endif

    </div>
</div>
@endsection
