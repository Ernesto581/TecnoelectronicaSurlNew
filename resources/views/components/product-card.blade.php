@props(['product' => null, 'link' => ''])

@php
$product = $product ?? (object)[
    'id' => 0,
    'name' => 'Producto',
    'slug' => 'producto',
    'description' => 'Descripción del producto.',
    'price' => 0,
    'original_price' => null,
    'image_url' => 'https://picsum.photos/seed/default/600/400',
    'badge' => null,
    'rating' => 0,
    'reviews_count' => 0,
    'categories' => (object)['name' => 'General'],
];
$link = $link ?: '/tienda/producto/' . $product->id;
@endphp

<div class="group bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full">
    <div class="relative h-60 w-full bg-gray-50 overflow-hidden">
        <img src="{{ $product->image_url ?? 'https://picsum.photos/seed/default/600/400' }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
        @if($product->badge)
        <div class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] font-black uppercase tracking-widest px-2 py-1 rounded-md shadow-lg">{{ $product->badge }}</div>
        @endif
    </div>
    <div class="p-5 flex flex-col flex-grow">
        <p class="text-[10px] text-blue-500 font-black uppercase tracking-[0.2em] mb-1">{{ $product->categories->name ?? 'General' }}</p>
        <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight group-hover:text-blue-600 transition-colors">{{ $product->name }}</h3>
        <p class="text-gray-500 text-sm line-clamp-2 mb-4 flex-grow">{{ $product->description ?? 'Sin descripción disponible.' }}</p>
        <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
            <div class="flex flex-col">
                <span class="text-2xl font-black text-gray-900">${{ number_format($product->price, 0) }}</span>
                @if($product->original_price)
                <span class="text-xs text-gray-400 line-through">${{ number_format($product->original_price, 0) }}</span>
                @endif
            </div>
            <a href="{{ $link }}" class="bg-gray-900 text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-blue-600 transition-all active:scale-95 shadow-md">Detalles</a>
        </div>
    </div>
</div>
