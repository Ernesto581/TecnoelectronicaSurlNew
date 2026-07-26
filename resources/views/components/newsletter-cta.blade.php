@props(['success' => false])

<section class="py-24 bg-gray-50 border-t border-gray-100">
    <div class="max-w-[1600px] mx-auto px-4 md:px-8">
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden relative">
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-[#46A040]/5 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-blue-500/5 blur-3xl"></div>
            <div class="relative p-8 md:p-16 flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="lg:w-1/2 text-center lg:text-left">
                    <div class="w-16 h-16 bg-[#46A040]/10 text-[#46A040] rounded-2xl flex items-center justify-center mb-6 mx-auto lg:mx-0">
                        <x-icon name="user" class="w-8 h-8" />
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 tracking-tight mb-4">¿Aún no tienes cuenta?</h2>
                    <p class="text-lg text-gray-600 max-w-xl mx-auto lg:mx-0">Regístrate para comprar, seguir tus pedidos y recibir nuestras novedades. Es gratis y toma menos de un minuto.</p>
                </div>
                <div class="lg:w-1/2 w-full max-w-md flex flex-col items-center lg:items-end gap-4">
                    <a href="{{ route('register') }}"
                       class="inline-flex px-8 py-4 bg-[#46A040] text-white font-bold rounded-full hover:bg-[#3d8c38] transition-colors shadow-md shadow-[#46A040]/20">
                        Crear cuenta gratis
                    </a>
                    <p class="text-sm text-gray-500">
                        ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-[#46A040] font-semibold hover:underline">Inicia sesión</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
