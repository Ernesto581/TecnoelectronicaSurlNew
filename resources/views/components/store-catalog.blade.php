@props(['productsJson' => '[]', 'categories' => null, 'searchQuery' => ''])

<style>
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fadeInUp 0.4s ease-out both; }
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    @keyframes priceReveal { from { clip-path: inset(0 100% 0 0); } to { clip-path: inset(0 0 0 0); } }
    .price-reveal { animation: priceReveal 0.5s ease-out both; }
    [x-cloak] { display: none !important; }
</style>

<div
    x-data='catalog(@json($productsJson), @json($categories), "{{ $searchQuery }}")'
    x-init="initSticky()"
    x-cloak
>
    <div class="relative pt-28 pb-20 bg-gray-900 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
        <div class="relative z-10 max-w-[1600px] mx-auto px-4 md:px-8 text-center pt-8">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-bold text-white tracking-tight mb-4">Nuestra Tienda</h1>
            <p class="text-lg text-gray-300 max-w-xl mx-auto mb-8 leading-relaxed">Explora nuestra amplia variedad de productos y encuentra lo que necesitas</p>
            <div class="relative max-w-lg mx-auto">
                <input type="text" x-model="searchQuery" placeholder="Buscar en el inventario..." class="w-full px-5 py-4 bg-white border border-white/20 rounded-2xl focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm transition-all placeholder:text-gray-400 shadow-lg" />
            </div>
        </div>
    </div>

    <div
        x-ref="filterBar"
        :class="sticky ? 'sticky top-20 z-30 shadow-sm border-b border-gray-200' : 'border-b border-gray-100'"
        class="bg-white/95 backdrop-blur-md transition-all duration-200"
    >
        <div class="max-w-[1600px] mx-auto px-4 md:px-8 py-4">
            <!-- Alineación ajustada para móvil (justify-start) y escritorio (md:justify-center) -->
            <div class="flex items-center justify-start md:justify-center gap-2 overflow-x-auto scrollbar-hide pb-1 px-2">
                <template x-for="cat in ['Todos', ...categories.map(c => c.name)]" :key="cat">
                    <button @click="activeCategory = cat"
                        :class="activeCategory === cat
                            ? 'bg-[#46A040] text-white ring-1 ring-[#46A040]'
                            : 'bg-white text-gray-600 border border-gray-200 hover:border-[#46A040] hover:text-[#46A040]'"
                        class="shrink-0 px-4 py-2 rounded-lg text-xs font-semibold font-mono uppercase tracking-wider transition-all flex items-center gap-1.5">
                        <span :class="activeCategory === cat ? 'bg-white' : 'bg-gray-300'" class="w-1.5 h-1.5 rounded-full shrink-0"></span>
                        <span x-text="cat"></span>
                    </button>
                </template>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center gap-4 flex-wrap">
                    <p class="text-xs text-gray-500 font-medium">Productos <span class="font-bold text-gray-900" x-text="filteredProducts.length"></span></p>
                    
                    <div class="flex items-center gap-2 bg-gray-50 rounded-xl border border-gray-100 px-3 py-1.5">
                        <span class="text-[10px] font-mono font-semibold text-gray-400 uppercase tracking-wider">Precio:</span>
                        <div class="flex items-center gap-1.5">
                            <span class="text-xs text-gray-400 font-mono">$</span>
                            <input 
                                type="number" 
                                min="0" 
                                x-model.number="minPrice" 
                                placeholder="M&iacute;n" 
                                class="w-16 px-2 py-1 bg-white border border-gray-200 rounded-lg text-xs font-mono font-bold text-gray-900 outline-none focus:border-[#46A040] focus:ring-1 focus:ring-[#46A040] [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                            />
                            <span class="text-xs text-gray-300 font-mono">&ndash;</span>
                            <span class="text-xs text-gray-400 font-mono">$</span>
                            <input 
                                type="number" 
                                min="0" 
                                x-model.number="maxPrice" 
                                placeholder="M&aacute;x" 
                                class="w-16 px-2 py-1 bg-white border border-gray-200 rounded-lg text-xs font-mono font-bold text-gray-900 outline-none focus:border-[#46A040] focus:ring-1 focus:ring-[#46A040] [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                            />
                        </div>
                        <button 
                            x-show="minPrice !== null || maxPrice !== null" 
                            @click="minPrice = null; maxPrice = null" 
                            class="text-[10px] font-mono font-semibold text-gray-400 hover:text-red-500 transition-colors ml-1"
                            title="Limpiar precio"
                        >
                            &times;
                        </button>
                    </div>
                </div>

                <select x-model="sortBy" class="bg-gray-50 border border-gray-100 px-4 py-2 rounded-xl text-xs font-mono font-semibold uppercase tracking-wider outline-none focus:ring-2 focus:ring-[#46A040] cursor-pointer text-gray-600">
                    <option value="relevance">Relevancia</option>
                    <option value="price-asc">Precio &uarr;</option>
                    <option value="price-desc">Precio &darr;</option>
                    <option value="name">A&ndash;Z</option>
                </select>
            </div>
        </div>
    </div>

    <div class="bg-surface pb-24">
    <div class="max-w-[1600px] mx-auto px-4 md:px-8 py-8">
        <template x-if="filteredProducts.length === 0">
            <div class="text-center py-24 bg-white rounded-3xl border border-gray-100 shadow-sm">
                <div class="w-16 h-16 rounded-2xl bg-[#ecf8ef] flex items-center justify-center mx-auto mb-4">
                    <x-icon name="package" class="w-8 h-8 text-[#46A040]" />
                </div>
                <h3 class="text-xl font-display font-bold text-gray-900 mb-2">No se encontraron productos</h3>
                <p class="text-gray-500 text-sm mb-6">Intenta ajustando los filtros de b&uacute;squeda.</p>
                <button @click="activeCategory = 'Todos'; searchQuery = ''; minPrice = null; maxPrice = null" class="inline-flex items-center gap-2 px-6 py-3 bg-[#46A040] text-white font-semibold rounded-xl hover:bg-[#3d8c38] transition-colors shadow-md shadow-[#46A040]/20 font-mono text-xs uppercase tracking-wider">
                    Limpiar filtros
                </button>
            </div>
        </template>

        <template x-if="filteredProducts.length > 0">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                <template x-for="(product, index) in sortedProducts" :key="product.id">
                    <a :href="'/tienda/producto/' + product.slug"
                       class="group bg-white rounded-xl border border-gray-100 hover:border-[#46A040]/30 hover:shadow-lg transition-all duration-300 flex flex-col overflow-hidden animate-fade-in"
                       :style="{ animationDelay: (index * 40) + 'ms' }">
                        <div class="relative aspect-[4/3] overflow-hidden bg-gray-50">
                            <template x-if="product.badge">
                                <div class="absolute top-3 left-3 z-10 bg-[#46A040] text-white text-[9px] font-mono font-bold uppercase tracking-wider px-2 py-1 rounded-md shadow-md" x-text="product.badge"></div>
                            </template>
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/[0.02] transition-colors duration-500 z-[1]"></div>
                            <img :src="product.image_url" :alt="product.name" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy" />
                        </div>

                        <div class="h-px bg-gradient-to-r from-[#46A040]/0 via-[#46A040]/20 to-[#46A040]/0"></div>

                        <div class="p-4 flex flex-col flex-1 gap-1.5">
                            <h3 class="text-sm font-display font-bold text-gray-900 leading-snug line-clamp-2" x-text="product.name"></h3>
                            <p class="text-[11px] text-gray-500 line-clamp-2 leading-relaxed flex-1" x-text="product.description || 'Sin descripci&oacute;n disponible.'"></p>
                            <div class="mt-auto pt-3">
                                <div class="flex items-baseline gap-2">
                                    <span class="text-xl font-mono font-bold text-gray-900 tracking-tight price-reveal" x-text="'$' + Number(product.price).toFixed(2)"></span>
                                    <template x-if="product.original_price != null">
                                        <span class="text-xs font-mono text-gray-400 line-through" x-text="'$' + Number(product.original_price).toFixed(2)"></span>
                                    </template>
                                </div>
                                <div class="mt-1.5 flex items-center justify-between">
                                    <div class="w-8 h-0.5 bg-gradient-to-r from-[#46A040]/50 to-transparent rounded-full"></div>
                                    <button @click.prevent="alert('Carrito pr&oacute;ximo')" class="text-[10px] font-mono font-bold uppercase tracking-wider text-gray-400 hover:text-[#46A040] transition-colors flex items-center gap-1" aria-label="Añadir al carrito">
                                        <x-icon name="shopping-cart" class="w-3 h-3" />
                                        Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                </template>
            </div>
        </template>
    </div>
    </div>
</div>

@push('scripts')
<script>
    function catalog(products, categories, initialSearch) {
        return {
            products: products,
            categories: categories,
            activeCategory: 'Todos',
            searchQuery: initialSearch || '',
            minPrice: null,
            maxPrice: null,
            sortBy: 'relevance',
            sticky: false,
            filterBarOffset: null,

            initSticky() {
                this.$nextTick(() => {
                    this.filterBarOffset = this.$refs.filterBar.offsetTop;
                });
                window.addEventListener('scroll', () => {
                    if (!this.filterBarOffset && this.$refs.filterBar) {
                        this.filterBarOffset = this.$refs.filterBar.offsetTop;
                    }
                    this.sticky = window.scrollY > (this.filterBarOffset || 300) - 80;
                });
            },

            get filteredProducts() {
                return this.products.filter(p => {
                    const price = Number(p.price);
                    const matchCategory = this.activeCategory === 'Todos' || p.categoryName === this.activeCategory;
                    const matchSearch = p.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                                       (p.description && p.description.toLowerCase().includes(this.searchQuery.toLowerCase()));
                    
                    const matchMin = this.minPrice === null || this.minPrice === '' || price >= this.minPrice;
                    const matchMax = this.maxPrice === null || this.maxPrice === '' || price <= this.maxPrice;

                    return matchCategory && matchSearch && matchMin && matchMax;
                });
            },

            get sortedProducts() {
                const filtered = [...this.filteredProducts];
                switch (this.sortBy) {
                    case 'price-asc': return filtered.sort((a, b) => Number(a.price) - Number(b.price));
                    case 'price-desc': return filtered.sort((a, b) => Number(b.price) - Number(a.price));
                    case 'name': return filtered.sort((a, b) => a.name.localeCompare(b.name));
                    default: return filtered;
                }
            }
        }
    }
</script>
@endpush