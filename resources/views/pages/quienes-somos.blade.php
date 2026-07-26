@extends('layouts.app')

@section('content')
<div class="relative pt-28 pb-20 bg-gray-900 overflow-hidden">
    <img src="https://picsum.photos/seed/companyvision/1920/600" alt="Visión de la Empresa" class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-40" />
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
    <div class="relative z-10 max-w-[1600px] mx-auto px-4 md:px-8 text-center pt-8">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-bold text-white tracking-tight mb-6">Quiénes <span class="text-[#46A040]">Somos</span></h1>
        <p class="text-lg text-gray-300 max-w-3xl mx-auto leading-relaxed">Descubre la solución definitiva para todas tus necesidades tecnológicas. Somos tu aliado confiable en venta, reparación y asesoramiento experto.</p>
    </div>
</div>

<section class="py-24 bg-white flex-1">
    <div class="max-w-[1200px] mx-auto px-4 md:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-24">
            <div>
                <h2 class="text-[#46A040] font-bold tracking-wider uppercase text-sm mb-3">Nuestra Propuesta</h2>
                <h3 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 mb-6 tracking-tight">Soluciones tecnológicas con compromiso y excelencia</h3>
                <div class="text-lg text-gray-600 leading-relaxed">
                    <p>Descubre la solución definitiva para todas tus necesidades tecnológicas con TecnoElectrónica SURL. Somos tu aliado confiable en la venta y reparación de equipos de computación. TecnoElectrónica SURL te ofrece diagnósticos precisos, reparaciones eficientes y asesoramiento experto para que vuelvas al trabajo sin demoras. Confía en nosotros para mantener tu tecnología en perfectas condiciones, asegurar tu productividad y proporcionarte la mejor experiencia posible. ¡Tu satisfacción es nuestra prioridad!</p>
                </div>
            </div>
            <div class="relative rounded-3xl overflow-hidden shadow-2xl h-[400px]">
                <img src="https://picsum.photos/seed/officehistory/800/800" alt="Nuestra Oficina" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" />
            </div>
        </div>

        <x-about-us />

        <div class="mt-16 text-center">
            <a href="{{ route('store.index') }}"
               class="inline-flex px-8 py-4 bg-[#46A040] text-white font-bold rounded-full hover:bg-[#3d8c38] transition-colors shadow-md shadow-[#46A040]/20">
                Explorar tienda
            </a>
        </div>
    </div>
</section>
@endsection
