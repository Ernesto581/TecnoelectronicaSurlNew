@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="h-28"></div>
    <div class="max-w-[1200px] mx-auto px-4 md:px-8 py-8">
        <a href="/tienda" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#46A040] transition-colors mb-6">
            <x-icon name="chevron-left" class="w-4 h-4" />
            Volver a la tienda
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            <div class="relative aspect-square rounded-2xl overflow-hidden bg-white border border-gray-100 shadow-sm">
                <div class="absolute top-4 left-4 z-10 bg-[#46A040] text-white text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-full shadow-md">Nuevo</div>
                <img src="https://picsum.photos/seed/product-detail/800/800" alt="Producto" class="w-full h-full object-cover" />
            </div>

            <div class="flex flex-col">
                <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Electrodomésticos</div>
                <h1 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 tracking-tight leading-tight">Producto de ejemplo</h1>

                <div class="flex items-center gap-1.5 mt-4">
                    <x-icon name="star" class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                    <span class="text-sm font-bold text-gray-700">4.8</span>
                    <span class="text-sm text-gray-400 ml-1">(120 reseñas)</span>
                </div>

                <div class="mt-6 flex items-baseline gap-3">
                    <span class="text-4xl font-black text-[#46A040]">$649.99</span>
                    <span class="text-xl text-gray-400 line-through font-medium">$799.99</span>
                    <span class="text-sm font-bold text-red-500 bg-red-50 px-2.5 py-1 rounded-full">-19%</span>
                </div>

                <div class="mt-8 space-y-4">
                    <button class="w-full flex items-center justify-center gap-3 bg-[#46A040] text-white font-bold py-4 rounded-xl hover:bg-[#3d8c38] transition-colors shadow-lg shadow-green-500/20">
                        <x-icon name="shopping-cart" class="w-5 h-5" />
                        Agregar al carrito
                    </button>
                    <div class="flex gap-3">
                        <button class="flex-1 flex items-center justify-center gap-2 border border-gray-200 text-gray-600 font-medium py-3 rounded-xl hover:bg-gray-50 transition-colors">
                            <x-icon name="heart" class="w-4 h-4" />
                            Favoritos
                        </button>
                        <button class="flex-1 flex items-center justify-center gap-2 border border-gray-200 text-gray-600 font-medium py-3 rounded-xl hover:bg-gray-50 transition-colors">
                            <x-icon name="share-2" class="w-4 h-4" />
                            Compartir
                        </button>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-3">Descripción</h3>
                    <p class="text-gray-600 leading-relaxed">Producto de alta calidad con las mejores prestaciones del mercado. Ideal para tu hogar u oficina.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
