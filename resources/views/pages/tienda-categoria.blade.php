@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="h-28"></div>
    <div class="max-w-[1600px] mx-auto px-4 md:px-8 py-12">
        <h1 class="text-4xl font-display font-bold text-gray-900 tracking-tight">{{ ucfirst(str_replace('-', ' ', $categoria)) }}</h1>
        <p class="mt-3 text-lg text-gray-600">Explora nuestros productos en {{ str_replace('-', ' ', $categoria) }}.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-10">
            @php
            $placeholderProducts = [
                (object)['id' => 1, 'name' => 'Producto 1', 'price' => 299.99, 'original_price' => 349.99, 'image' => 'https://picsum.photos/seed/cat1/600/400', 'badge' => 'Nuevo', 'rating' => 4.5],
                (object)['id' => 2, 'name' => 'Producto 2', 'price' => 149.99, 'original_price' => null, 'image' => 'https://picsum.photos/seed/cat2/600/400', 'badge' => null, 'rating' => 4.0],
                (object)['id' => 3, 'name' => 'Producto 3', 'price' => 499.99, 'original_price' => 599.99, 'image' => 'https://picsum.photos/seed/cat3/600/400', 'badge' => 'Oferta', 'rating' => 4.8],
                (object)['id' => 4, 'name' => 'Producto 4', 'price' => 89.99, 'original_price' => null, 'image' => 'https://picsum.photos/seed/cat4/600/400', 'badge' => null, 'rating' => 4.2],
            ];
            @endphp
            @foreach($placeholderProducts as $product)
            <a href="/tienda/producto/{{ $product->id }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden group">
                <div class="relative h-48 overflow-hidden bg-gray-50">
                    @if($product->badge)
                    <div class="absolute top-3 left-3 z-10 bg-[#46A040] text-white text-xs font-bold uppercase tracking-wider px-2.5 py-1 rounded-full shadow-md">{{ $product->badge }}</div>
                    @endif
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                </div>
                <div class="p-4 flex flex-col flex-1">
                    <h3 class="text-sm font-bold text-gray-900 mb-2 line-clamp-2">{{ $product->name }}</h3>
                    <div class="flex items-center gap-1 mb-3">
                        <x-icon name="star" class="w-3.5 h-3.5 fill-yellow-400 text-yellow-400" />
                        <span class="text-xs font-bold text-gray-700">{{ $product->rating }}</span>
                    </div>
                    <div class="mt-auto pt-3 flex items-center justify-between border-t border-gray-100">
                        <div class="flex flex-col">
                            @if($product->original_price)
                            <span class="text-xs text-gray-400 line-through font-medium">${{ number_format($product->original_price, 2) }}</span>
                            <span class="text-lg font-black text-[#46A040]">${{ number_format($product->price, 2) }}</span>
                            @else
                            <span class="text-lg font-black text-gray-900">${{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                        <button @click.prevent="alert('Carrito próximo')" class="w-9 h-9 rounded-full bg-gray-50 flex items-center justify-center text-gray-600 hover:bg-[#46A040] hover:text-white transition-colors">
                            <x-icon name="shopping-cart" class="w-4 h-4" />
                        </button>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
