@php
$slides = [
    (object)[
        'id' => 1,
        'title' => 'Electrodomésticos y Línea Blanca',
        'description' => 'Equipa tu hogar con la mejor tecnología. Refrigeradores, hornos, lavadoras y más de las marcas líderes, con garantía extendida.',
        'image' => '/linea-blanca-y-electrodomesticos.webp',
        'imageMobile' => '/linea-blanca-y-electrodomesticos-mobile.webp',
        'cta' => 'Ver Catálogo',
        'badge' => 'Nuevo Ingreso',
        'link' => '/tienda/electrodomesticos',
    ],
    (object)[
        'id' => 2,
        'title' => 'Alimentos y Víveres',
        'description' => 'Encuentra productos frescos, abarrotes y todo lo que necesitas para tu despensa diaria. Calidad y buenos precios.',
        'image' => '/alimentos-y-viveres.webp',
        'imageMobile' => '/alimentos-y-viveres-mobile.webp',
        'cta' => 'Comprar Ahora',
        'badge' => 'Ofertas',
        'link' => '/tienda/hogar',
    ],
    (object)[
        'id' => 3,
        'title' => 'Energía Solar y Renovable',
        'description' => 'Paneles solares, inversores y baterías. Transición hacia una energía limpia para reducir tus costos eléctricos.',
        'image' => '/energia-solar-y-renovable.webp',
        'imageMobile' => '/energia-solar-y-renovable-mobile.webp',
        'cta' => 'Solicitar Cotización',
        'badge' => 'Sostenibilidad',
        'link' => '/tienda/energia-solar',
    ],
    (object)[
        'id' => 4,
        'title' => 'Sublimación y Personalizados',
        'description' => 'Tazas, jarras y artículos promocionales personalizados. Diseños únicos para regalos o merchandising empresarial.',
        'image' => '/sublimacion-y-personalizados.webp',
        'imageMobile' => '/sublimacion-y-personalizados-mobile.webp',
        'cta' => 'Personaliza Aquí',
        'badge' => 'Creatividad',
        'link' => '/tienda/sublimacion',
    ],
    (object)[
        'id' => 5,
        'title' => 'Desarrollo de Software',
        'description' => 'Páginas web, aplicaciones y sistemas personalizados. Transformamos tus ideas en soluciones digitales funcionales.',
        'image' => '/software-y-soluciones.webp',
        'imageMobile' => '/software-y-soluciones-mobile.webp',
        'cta' => 'Explorar Soluciones',
        'badge' => 'Tecnología',
        'link' => '/servicios',
    ],
];
@endphp

<style>
    @keyframes heroZoom {
        from { transform: scale(1); }
        to { transform: scale(1.15); }
    }
</style>

<div
    x-data="carousel()"
    x-init="init()"
    class="relative h-screen min-h-[600px] w-full flex bg-gray-900 overflow-hidden"
>
    <template x-for="(slide, index) in slides" :key="slide.id">
        <div
            x-show="currentSlide === index"
            x-transition:enter="transition-opacity duration-700"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity duration-700"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0 w-full h-full"
        >
            <div class="absolute inset-0 w-full h-full">
                <img 
                    :src="isMobile ? slide.imageMobile : slide.image"
                    :alt="slide.title" 
                    :loading="index === 0 ? 'eager' : 'lazy'" 
                    class="w-full h-full object-cover"
                    :style="'animation: ' + (currentSlide === index ? 'heroZoom 6s ease-out forwards' : 'none')"
                />
                <div class="absolute inset-0 bg-black/30"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent"></div>
            </div>

            <div class="absolute inset-0 flex flex-col justify-end px-6 md:px-12 lg:px-24 pb-32 max-w-[1600px] mx-auto w-full z-10 pointer-events-none">
                <div class="max-w-3xl pointer-events-auto">
                    <div class="mb-6 inline-flex items-center gap-2 px-4 py-1.5 bg-white/10 backdrop-blur-md rounded-full text-xs font-bold uppercase tracking-wider text-white border border-white/20">
                        <span class="w-2 h-2 rounded-full bg-[#4CAF50]"></span>
                        <span x-text="slide.badge"></span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-7xl font-display font-medium text-white tracking-tight leading-[1.05] mb-6" x-text="slide.title"></h1>

                    <p class="text-lg md:text-xl text-white/80 max-w-2xl leading-relaxed mb-8" x-text="slide.description"></p>

                    <div class="flex flex-wrap gap-4">
                        <a :href="slide.link" class="flex items-center justify-center gap-2 px-8 py-4 bg-[#46A040] text-white font-medium rounded-full hover:bg-[#3d8c38] transition-colors shadow-lg shadow-[#46A040]/30 w-full sm:w-auto">
                            <x-icon name="shopping-bag" class="w-5 h-5" />
                            <span x-text="slide.cta"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <div class="absolute bottom-12 right-6 md:right-12 lg:right-24 flex items-center gap-3 z-20">
        <button @click="prevSlide()" class="w-12 h-12 rounded-full border border-white/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-white/10 transition-colors" title="Anterior">
            <x-icon name="chevron-left" class="w-5 h-5" />
        </button>
        <button @click="nextSlide()" class="w-12 h-12 rounded-full bg-white text-gray-900 flex items-center justify-center hover:bg-gray-100 transition-colors shadow-lg" title="Siguiente">
            <x-icon name="chevron-right" class="w-5 h-5" />
        </button>
    </div>

    <div class="absolute bottom-16 left-6 md:left-12 lg:left-24 flex gap-2 z-20">
        <template x-for="(slide, index) in slides" :key="index">
            <button
                @click="goToSlide(index)"
                :class="currentSlide === index ? 'bg-white w-8' : 'bg-white/30 w-2 hover:bg-white/50'"
                class="h-1.5 rounded-full transition-all duration-300"
                :aria-label="'Ir a la diapositiva ' + (index + 1)"
            ></button>
        </template>
    </div>
</div>

@push('scripts')
<script>
    function carousel() {
        return {
            currentSlide: 0,
            slides: @json($slides),
            timer: null,
            isMobile: false,
            checkMobile() {
                this.isMobile = window.innerWidth < 768;
            },
            mobileImage(slide) {
                return this.isMobile ? slide.imageMobile : slide.image;
            },
            init() {
                this.checkMobile();
                window.addEventListener("resize", () => this.checkMobile());
                this.startTimer();
            },
            startTimer() {
                this.timer = setInterval(() => {
                    this.nextSlide();
                }, 6000);
            },
            stopTimer() {
                clearInterval(this.timer);
            },
            nextSlide() {
                this.stopTimer();
                this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                this.startTimer();
            },
            prevSlide() {
                this.stopTimer();
                this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
                this.startTimer();
            },
            goToSlide(index) {
                this.stopTimer();
                this.currentSlide = index;
                this.startTimer();
            }
        }
    }
</script>
@endpush
