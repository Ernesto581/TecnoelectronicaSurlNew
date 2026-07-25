@extends('layouts.app')

@section('content')
<div class="relative pt-32 pb-20 bg-gray-900 overflow-hidden">
    <img src="https://picsum.photos/seed/companyvision/1920/600" alt="Visión de la Empresa" class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-40" />
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
    <div class="relative z-10 max-w-[1600px] mx-auto px-4 md:px-8 text-center pt-8">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-bold text-white tracking-tight mb-6">Quiénes <span class="text-[#46A040]">Somos</span></h1>
        <p class="text-lg text-gray-300 max-w-3xl mx-auto leading-relaxed">Más de 4 años de experiencia brindando soluciones integrales. Conoce nuestra historia, nuestra misión y los valores que impulsan a Tecnoelectronica SURL.</p>
    </div>
</div>

<section class="py-24 bg-white flex-1">
    <div class="max-w-[1200px] mx-auto px-4 md:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-24">
            <div>
                <h2 class="text-[#46A040] font-bold tracking-wider uppercase text-sm mb-3">Nuestra Historia</h2>
                <h3 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 mb-6 tracking-tight">Evolución constante desde 2022</h3>
                <div class="text-lg text-gray-600 leading-relaxed">
                    <p>Descubre la solución definitiva para todas tus necesidades tecnológicas con TecnoElectrónica SURL. Somos tu aliado confiable en la venta y reparación de equipos de computación. TecnoElectrónica SURL te ofrece diagnósticos precisos, reparaciones eficientes y asesoramiento experto para que vuelvas al trabajo sin demoras. Confía en nosotros para mantener tu tecnología en perfectas condiciones, asegurar tu productividad y proporcionarte la mejor experiencia posible. ¡Tu satisfacción es nuestra prioridad!</p>
                </div>
            </div>
            <div class="relative rounded-3xl overflow-hidden shadow-2xl h-[400px]">
                <img src="https://picsum.photos/seed/officehistory/800/800" alt="Nuestra Oficina" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" />
            </div>
        </div>

        <div>
            <h3 class="text-3xl font-display font-bold text-center text-gray-900 mb-12 tracking-tight">Nuestros Pilares</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                $values = [
                    (object)['icon' => 'zap', 'title' => 'Innovación', 'desc' => 'Mantenemos nuestro catálogo actualizado con lo último en tecnología.'],
                    (object)['icon' => 'shield-check', 'title' => 'Confiabilidad', 'desc' => 'Productos con garantía y el mejor soporte post-venta del mercado.'],
                    (object)['icon' => 'target', 'title' => 'Precisión', 'desc' => 'Evaluamos las necesidades de cada cliente para dar soluciones a medida.'],
                    (object)['icon' => 'users', 'title' => 'Servicio', 'desc' => 'El cliente y su satisfacción son siempre nuestra prioridad central.'],
                ];
                @endphp
                @foreach($values as $value)
                <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 hover:shadow-lg transition-all text-center group">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm border border-gray-100 group-hover:scale-110 transition-transform">
                        <x-icon name="{{ $value->icon }}" class="w-8 h-8 text-[#46A040]" />
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">{{ $value->title }}</h4>
                    <p class="text-gray-600">{{ $value->desc }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
