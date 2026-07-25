@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-surface">
    <div class="max-w-[1200px] mx-auto px-4 md:px-8 pt-28 pb-16">
        <div class="flex items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-wider text-gray-400 mb-8 flex-wrap">
            <a href="/tienda" class="hover:text-[#46A040] transition-colors">Tienda</a>
            <span class="text-gray-300">/</span>
            <a href="/tienda/{{ $product->category->slug ?? '#' }}" class="hover:text-[#46A040] transition-colors">{{ $product->category->name ?? 'General' }}</a>
            <span class="text-gray-300">/</span>
            <span class="text-[#46A040] truncate max-w-[200px]">{{ $product->name }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            <div class="relative aspect-square rounded-2xl overflow-hidden bg-white border border-gray-100 shadow-sm">
                @if($product->badge)
                <div class="absolute top-4 left-4 z-10 bg-[#46A040] text-white text-[10px] font-mono font-bold uppercase tracking-wider px-3 py-1.5 rounded-md shadow-md">{{ $product->badge }}</div>
                @endif
                <img src="{{ $product->image_url ?? 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=600&h=400&fit=crop' }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
            </div>

            <div class="flex flex-col">
                <span class="text-[9px] font-mono font-semibold text-[#46A040] uppercase tracking-[0.15em] mb-3">[ {{ $product->category->name ?? 'General' }} ]</span>
                <h1 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 tracking-tight leading-tight">{{ $product->name }}</h1>

                <div class="flex items-center gap-1.5 mt-4">
                    <x-icon name="star" class="w-4 h-4 fill-yellow-400 text-yellow-400" />
                    <span class="text-sm font-bold text-gray-700">{{ number_format($product->rating, 1) }}</span>
                    <span class="text-sm text-gray-400">({{ $product->reviews_count }} rese&ntilde;as)</span>
                </div>

                <div class="mt-6 bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <div class="flex items-baseline gap-3 mb-1">
                        <span class="text-3xl lg:text-4xl font-mono font-bold text-gray-900 tracking-tight">${{ number_format($product->price, 2) }}</span>
                        @if($product->original_price)
                        <span class="text-lg font-mono text-gray-400 line-through">${{ number_format($product->original_price, 2) }}</span>
                        @if($discount > 0)
                        <span class="text-xs font-mono font-bold text-[#46A040] bg-[#ecf8ef] px-2.5 py-1 rounded-md">-{{ $discount }}%</span>
                        @endif
                        @endif
                    </div>
                    <div class="w-12 h-0.5 bg-gradient-to-r from-[#46A040]/50 to-transparent rounded-full mt-1 mb-4"></div>

                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-6">
                        <x-icon name="package" class="w-4 h-4" />
                        <span>{{ $product->stock > 0 ? $product->stock . ' unidades disponibles' : 'Agotado' }}</span>
                    </div>

                    @if (session('cart_error'))
                        <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">{{ session('cart_error') }}</div>
                    @endif
                    @if (session('cart_success'))
                        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">{{ session('cart_success') }}</div>
                    @endif

                    @auth
                        @if ($product->stock > 0)
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="flex items-center gap-3">
                                @csrf
                                <div class="flex items-center rounded-xl border border-gray-200 bg-white">
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                           class="w-14 text-center py-3 text-sm font-semibold border-none focus:ring-0 rounded-l-xl" />
                                </div>
                                <button type="submit" class="flex-1 flex items-center justify-center gap-3 bg-[#46A040] text-white font-bold py-3 rounded-xl hover:bg-[#3d8c38] transition-colors shadow-md shadow-[#46A040]/20">
                                    <x-icon name="shopping-cart" class="w-5 h-5" />
                                    Agregar al carrito
                                </button>
                            </form>
                        @else
                            <button disabled class="w-full flex items-center justify-center gap-3 bg-gray-200 text-gray-400 font-bold py-4 rounded-xl cursor-not-allowed">
                                <x-icon name="shopping-cart" class="w-5 h-5" />
                                Agotado
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                           class="w-full flex items-center justify-center gap-3 bg-[#46A040] text-white font-bold py-4 rounded-xl hover:bg-[#3d8c38] transition-colors shadow-md shadow-[#46A040]/20">
                            <x-icon name="log-in" class="w-5 h-5" />
                            Inicia sesión para comprar
                        </a>
                    @endauth
                </div>

                @if($product->description)
                <div class="mt-8">
                    <h3 class="text-sm font-mono font-semibold text-gray-400 uppercase tracking-wider mb-3">Descripci&oacute;n</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection