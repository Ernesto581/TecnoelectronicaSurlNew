@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-surface">
    <div class="max-w-[1600px] mx-auto px-4 md:px-8 pt-28 pb-16">
        <div class="flex items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-wider text-gray-400 mb-8">
            <a href="/tienda" class="hover:text-[#46A040] transition-colors">Tienda</a>
            <span class="text-gray-300">/</span>
            <span class="text-[#46A040]">{{ $category->name }}</span>
        </div>

        <div class="mb-12">
            <h1 class="text-4xl lg:text-5xl font-display font-bold text-gray-900 tracking-tight mb-4">{{ $category->name }}</h1>
            <p class="text-base text-gray-500 max-w-2xl leading-relaxed">{{ $category->description }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @forelse($products as $product)
            <a href="/tienda/producto/{{ $product['id'] }}" class="group bg-white rounded-xl border border-gray-100 hover:border-[#46A040]/30 hover:shadow-lg transition-all duration-300 flex flex-col overflow-hidden">
                <div class="relative aspect-[4/3] overflow-hidden bg-gray-50">
                    @if($product['badge'])
                    <div class="absolute top-3 left-3 z-10 bg-[#46A040] text-white text-[9px] font-mono font-bold uppercase tracking-wider px-2 py-1 rounded-md shadow-md">{{ $product['badge'] }}</div>
                    @endif
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/[0.02] transition-colors duration-500 z-[1]"></div>
                    <img src="{{ $product['image_url'] ?? 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=600&h=400&fit=crop' }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy" />
                </div>

                <div class="h-px bg-gradient-to-r from-[#46A040]/0 via-[#46A040]/20 to-[#46A040]/0"></div>

                <div class="p-4 flex flex-col flex-1 gap-1.5">
                    <h3 class="text-sm font-display font-bold text-gray-900 leading-snug line-clamp-2">{{ $product['name'] }}</h3>
                    <p class="text-[11px] text-gray-500 line-clamp-2 leading-relaxed flex-1">{{ $product['description'] ?? 'Sin descripci&oacute;n disponible.' }}</p>
                    <div class="mt-auto pt-3">
                        <div class="flex items-baseline gap-2">
                            <span class="text-xl font-mono font-bold text-gray-900 tracking-tight">${{ number_format($product['price'], 2) }}</span>
                            @if($product['original_price'])
                            <span class="text-xs font-mono text-gray-400 line-through">${{ number_format($product['original_price'], 2) }}</span>
                            @endif
                        </div>
                        <div class="mt-1.5 flex items-center justify-between">
                            <div class="w-8 h-0.5 bg-gradient-to-r from-[#46A040]/50 to-transparent rounded-full"></div>
                            <button @click.prevent="alert('Carrito pr&oacute;ximo')" class="text-[10px] font-mono font-bold uppercase tracking-wider text-gray-400 hover:text-[#46A040] transition-colors flex items-center gap-1" aria-label="A&ntilde;adir al carrito">
                                <x-icon name="shopping-cart" class="w-3 h-3" />
                                Agregar
                            </button>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-24 bg-white rounded-3xl border border-gray-100 shadow-sm">
                <div class="w-16 h-16 rounded-2xl bg-[#ecf8ef] flex items-center justify-center mx-auto mb-4">
                    <x-icon name="package" class="w-8 h-8 text-[#46A040]" />
                </div>
                <h3 class="text-xl font-display font-bold text-gray-900 mb-2">No hay productos en esta categor&iacute;a</h3>
                <p class="text-gray-500 text-sm mb-6">Estamos agregando nuevos productos. &iexcl;Vuelve pronto!</p>
                <a href="/tienda" class="inline-flex items-center gap-2 px-6 py-3 bg-[#46A040] text-white font-semibold rounded-xl hover:bg-[#3d8c38] transition-colors shadow-md shadow-[#46A040]/20 font-mono text-xs uppercase tracking-wider">Ver todas las categor&iacute;as</a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection