@props(['categories' => null])

@php
if (!isset($categories) || $categories->isEmpty()) {
    $categories = \App\Models\Category::all();
}

$colorClasses = [
    'bg-blue-50 text-blue-600',
    'bg-orange-50 text-orange-600',
    'bg-yellow-50 text-yellow-600',
    'bg-pink-50 text-pink-600',
    'bg-purple-50 text-purple-600',
    'bg-green-50 text-green-600',
];
@endphp

<section id="categorias" class="py-24 bg-white relative">
    <div class="max-w-[1600px] mx-auto px-4 md:px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="max-w-2xl">
                <h2 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 tracking-tight">Explora Nuestras Categorías</h2>
                <p class="mt-4 text-lg text-gray-600">Desde tecnología de punta hasta los suministros diarios que necesitas. Descubre nuestra variada oferta de productos y servicios.</p>
            </div>
            <a href="/tienda" class="group flex items-center gap-2 text-[#46A040] font-semibold hover:text-[#3d8c38] transition-colors">
                Ver todas las categorías
                <x-icon name="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform" />
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6">
            @foreach($categories as $index => $cat)
            @php
                $spanClass = $index === 0 ? 'md:col-span-2 lg:col-span-2 row-span-2' : 'md:col-span-1 lg:col-span-2';
                $color = $colorClasses[$index % count($colorClasses)];
            @endphp
            @php
                $bgImage = $cat->image ? "background-image: url({$cat->image}); background-size: cover; background-position: center;" : 'background-color: #f3f4f6;';
            @endphp
            <div class="group relative overflow-hidden rounded-2xl {{ $spanClass }} min-h-[280px] cursor-pointer shadow-sm hover:shadow-xl transition-all duration-500" style="{{ $bgImage }}">
                <a href="/tienda/{{ $cat->slug }}" class="absolute inset-0 z-10"></a>
                <div class="absolute inset-0 bg-gradient-to-br from-gray-900/70 to-gray-900/40 transition-opacity duration-500"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent"></div>
                <div class="absolute inset-0 p-8 flex flex-col justify-end">
                    <div class="transform transition-transform duration-500 group-hover:-translate-y-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4 {{ $color }} bg-white shadow-lg">
                            <x-icon name="{{ $cat->icon }}" class="w-6 h-6" />
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">{{ $cat->name }}</h3>
                        <p class="text-white/80 font-medium mb-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100 h-0 group-hover:h-auto overflow-hidden">Explora productos en {{ $cat->name }}</p>
                    </div>
                    <div class="absolute bottom-6 left-8 opacity-0 group-hover:opacity-100 transition-all duration-500 delay-200 translate-y-4 group-hover:translate-y-0">
                        <span class="flex items-center gap-2 text-[#4CAF50] font-bold text-sm uppercase tracking-wider">Explorar catálogo <x-icon name="arrow-right" class="w-4 h-4" /></span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
