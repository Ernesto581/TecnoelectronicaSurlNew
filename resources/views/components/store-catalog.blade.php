<div
    x-data="catalog()"
    x-init="init()"
    class="max-w-[1600px] mx-auto px-4 md:px-8 py-12 flex flex-col lg:flex-row gap-8 relative w-full min-h-screen"
>
    <button @click="isMobileFiltersOpen = !isMobileFiltersOpen" class="lg:hidden flex items-center justify-center gap-2 bg-white border border-gray-200 px-4 py-3 rounded-xl font-medium shadow-sm">
        <x-icon name="sliders" class="w-5 h-5 text-[#46A040]" />
        <span x-text="isMobileFiltersOpen ? 'Ocultar Filtros' : 'Mostrar Filtros'"></span>
    </button>

    <aside x-show="isMobileFiltersOpen" class="lg:block lg:w-1/4 xl:w-1/5 bg-white rounded-3xl p-6 shadow-sm border border-gray-100 shrink-0 h-fit" :class="isMobileFiltersOpen ? 'block' : 'hidden'">
        <div class="mb-8">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Buscar</h3>
            <div class="relative">
                <x-icon name="search" class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" />
                <input type="text" x-model="searchQuery" placeholder="¿Qué necesitas?" class="w-full pl-10 pr-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-[#46A040] text-sm" />
            </div>
        </div>

        <div class="mb-8 border-t border-gray-100 pt-8">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Categorías</h3>
            <div class="space-y-2">
                <template x-for="cat in ['Todos', ...categories.map(c => c.name)]" :key="cat">
                    <button @click="activeCategory = cat" :class="activeCategory === cat ? 'bg-[#46A040]/10 text-[#46A040] font-bold' : 'text-gray-600 hover:bg-gray-50'" class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl text-left text-sm transition-colors">
                        <span x-text="cat"></span>
                        <template x-if="activeCategory === cat">
                            <x-icon name="check" class="w-4 h-4" />
                        </template>
                    </button>
                </template>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900">Precio Máximo</h3>
                <span class="font-bold text-[#46A040]" x-text="'$' + priceRange"></span>
            </div>
            <input type="range" min="0" max="1000" x-model="priceRange" class="w-full accent-[#46A040]" />
            <div class="flex justify-between text-xs text-gray-400 mt-2 font-medium"><span>$0</span><span>$1000+</span></div>
        </div>
    </aside>

    <div class="flex-1">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <p class="text-gray-600 font-medium">Mostrando <span class="font-bold text-gray-900" x-text="filteredProducts.length"></span> productos</p>
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500 font-medium">Ordenar por:</span>
                <div class="relative group cursor-pointer bg-white border border-gray-200 px-4 py-2 rounded-xl flex items-center gap-2 text-sm font-medium">
                    Relevancia
                    <x-icon name="chevron-down" class="w-4 h-4 text-gray-400" />
                </div>
            </div>
        </div>

        <template x-if="loading">
            <div class="text-center py-20 bg-white rounded-3xl border border-gray-100">
                <div class="w-8 h-8 border-2 border-[#46A040] border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
                <p class="text-gray-400">Cargando productos...</p>
            </div>
        </template>

        <template x-if="!loading && filteredProducts.length === 0">
            <div class="text-center py-20 bg-white rounded-3xl border border-gray-100">
                <x-icon name="sliders" class="w-12 h-12 text-gray-300 mx-auto mb-4" />
                <h3 class="text-xl font-bold text-gray-900 mb-2">No se encontraron productos</h3>
                <p class="text-gray-500">Intenta ajustando los filtros de búsqueda.</p>
                <button @click="activeCategory = 'Todos'; searchQuery = ''; priceRange = 1000" class="mt-6 text-[#46A040] font-bold hover:underline">Limpiar filtros</button>
            </div>
        </template>

        <template x-if="!loading && filteredProducts.length > 0">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <template x-for="product in filteredProducts" :key="product.id">
                    <a :href="'/tienda/producto/' + product.id" class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-green-100 transition-all duration-300 flex flex-col group overflow-hidden">
                        <div class="relative h-56 overflow-hidden bg-gray-50">
                            <template x-if="product.badge">
                                <div class="absolute top-4 left-4 z-10 bg-[#46A040] text-white text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded-full shadow-md" x-text="product.badge"></div>
                            </template>
                            <img :src="product.image_url || 'https://picsum.photos/seed/placeholder/600/400'" :alt="product.name" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 mix-blend-multiply" />
                        </div>
                        <div class="p-5 flex flex-col flex-1 bg-white">
                            <div class="text-[10px] font-bold text-gray-400 mb-1.5 uppercase tracking-widest" x-text="product.categoryName"></div>
                            <h3 class="text-base font-bold text-gray-900 mb-2 leading-tight line-clamp-2" x-text="product.name"></h3>
                            <div class="flex items-center gap-1 mb-4">
                                <x-icon name="star" class="w-3.5 h-3.5 fill-yellow-400 text-yellow-400" />
                                <span class="text-sm font-bold text-gray-700" x-text="Number(product.rating || 0).toFixed(1)"></span>
                                <span class="text-xs text-gray-400 font-medium ml-1" x-text="'(' + (product.reviews_count || 0) + ')'"></span>
                            </div>
                            <div class="mt-auto pt-4 flex items-end justify-between border-t border-gray-50">
                                <div>
                                    <span class="text-xl font-black text-[#46A040] leading-none" x-text="'$' + Number(product.price).toFixed(2)"></span>
                                    <template x-if="product.original_price != null">
                                        <span class="block text-sm text-gray-400 line-through" x-text="'$' + Number(product.original_price).toFixed(2)"></span>
                                    </template>
                                </div>
                                <button @click.prevent="alert('Carrito próximo')" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-600 hover:bg-[#46A040] hover:text-white transition-colors group-hover:bg-[#46A040] group-hover:text-white" aria-label="Añadir al carrito">
                                    <x-icon name="shopping-cart" class="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                    </a>
                </template>
            </div>
        </template>
    </div>
</div>

@push('scripts')
<script>
    function catalog() {
        return {
            products: [],
            categories: [],
            loading: true,
            activeCategory: 'Todos',
            searchQuery: '',
            priceRange: 1000,
            isMobileFiltersOpen: false,

            async init() {
                const placeholderProducts = [
                    { id: 1, name: 'Refrigerador Samsung', price: 899.99, original_price: 1099.99, image_url: 'https://picsum.photos/seed/prod1/600/400', categoryName: 'Electrodomésticos', badge: 'Oferta', rating: 4.5, reviews_count: 120 },
                    { id: 2, name: 'Panel Solar 300W', price: 449.99, original_price: null, image_url: 'https://picsum.photos/seed/prod2/600/400', categoryName: 'Energía Solar', badge: null, rating: 4.8, reviews_count: 65 },
                    { id: 3, name: 'Laptop HP ProBook', price: 1299.00, original_price: 1499.00, image_url: 'https://picsum.photos/seed/prod3/600/400', categoryName: 'Tecnología', badge: 'Nuevo', rating: 4.7, reviews_count: 210 },
                    { id: 4, name: 'Cafetera Expreso', price: 189.00, original_price: null, image_url: 'https://picsum.photos/seed/prod4/600/400', categoryName: 'Hogar', badge: null, rating: 4.3, reviews_count: 45 },
                    { id: 5, name: 'Lavadora LG 15kg', price: 749.99, original_price: 849.99, image_url: 'https://picsum.photos/seed/prod5/600/400', categoryName: 'Electrodomésticos', badge: 'Destacado', rating: 4.6, reviews_count: 98 },
                    { id: 6, name: 'Batería Litio 5kW', price: 1890.00, original_price: null, image_url: 'https://picsum.photos/seed/prod6/600/400', categoryName: 'Energía Solar', badge: 'Nuevo', rating: 5.0, reviews_count: 12 },
                    { id: 7, name: 'Licencia Office 365', price: 99.99, original_price: 149.99, image_url: 'https://picsum.photos/seed/prod7/600/400', categoryName: 'Software', badge: 'Oferta', rating: 4.4, reviews_count: 340 },
                    { id: 8, name: 'Taza Personalizada', price: 12.99, original_price: null, image_url: 'https://picsum.photos/seed/prod8/600/400', categoryName: 'Sublimación', badge: null, rating: 4.2, reviews_count: 55 },
                ];

                this.categories = [
                    { id: 1, name: 'Electrodomésticos', slug: 'electrodomesticos' },
                    { id: 2, name: 'Energía Solar', slug: 'energia-solar' },
                    { id: 3, name: 'Software', slug: 'software' },
                    { id: 4, name: 'Sublimación', slug: 'sublimacion' },
                    { id: 5, name: 'Abarrotes', slug: 'abarrotes' },
                    { id: 6, name: 'Hogar', slug: 'hogar' },
                ];

                this.products = placeholderProducts;
                this.loading = false;
            },

            get filteredProducts() {
                return this.products.filter(p => {
                    const matchCategory = this.activeCategory === 'Todos' || p.categoryName === this.activeCategory;
                    const matchSearch = p.name.toLowerCase().includes(this.searchQuery.toLowerCase());
                    const matchPrice = p.price <= this.priceRange;
                    return matchCategory && matchSearch && matchPrice;
                });
            }
        }
    }
</script>
@endpush
