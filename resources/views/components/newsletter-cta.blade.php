<section class="py-24 bg-gray-50 border-t border-gray-100">
    <div class="max-w-[1600px] mx-auto px-4 md:px-8">
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden relative">
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-[#46A040]/5 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-blue-500/5 blur-3xl"></div>
            <div class="relative p-8 md:p-16 flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="lg:w-1/2 text-center lg:text-left">
                    <div class="w-16 h-16 bg-[#46A040]/10 text-[#46A040] rounded-2xl flex items-center justify-center mb-6 mx-auto lg:mx-0">
                        <x-icon name="mail" class="w-8 h-8" />
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 tracking-tight mb-4">No te pierdas ninguna oferta</h2>
                    <p class="text-lg text-gray-600 max-w-xl mx-auto lg:mx-0">Suscríbete a nuestro boletín para recibir promociones exclusivas, nuevos ingresos de electrodomésticos y actualizaciones de nuestros servicios.</p>
                </div>
                <div class="lg:w-1/2 w-full max-w-md">
                    <form class="flex flex-col sm:flex-row gap-3">
                        <div class="flex-1">
                            <label for="email-address" class="sr-only">Correo electrónico</label>
                            <input id="email-address" name="email" type="email" autocomplete="email" required class="min-w-0 w-full rounded-full border-0 px-6 py-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#46A040] sm:text-sm sm:leading-6" placeholder="Tu correo electrónico" />
                        </div>
                        <button type="submit" class="flex-none rounded-full bg-[#46A040] px-8 py-4 text-sm font-bold text-white shadow-sm hover:bg-[#3d8c38] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#46A040] transition-colors">Suscribirme</button>
                    </form>
                    <p class="mt-4 text-sm text-gray-500 text-center lg:text-left">Respetamos tu privacidad. Nunca enviaremos spam.</p>
                </div>
            </div>
        </div>
    </div>
</section>
