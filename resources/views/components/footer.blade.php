<footer class="bg-[#050505] text-[#F5F5F5] pt-16 pb-10 border-t border-gray-900">
    <div class="max-w-[1600px] mx-auto px-4 md:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 mb-16">

            <div class="lg:col-span-1 flex flex-col">
                <a href="/" class="flex items-center gap-3 group mb-6">
                    <img src="/logo.png" alt="Tecnoelectronica" class="h-12 w-auto object-contain" />
                    <div class="flex flex-col leading-tight">
                        <span class="text-lg font-bold tracking-tight text-white">Tecnoelectronica <span class="text-[#46A040]">SURL</span></span>
                        <span class="text-[11px] font-medium leading-none text-white/60">Creatividad y suministros a su alcance</span>
                    </div>
                </a>
                <div class="flex gap-4">
                    <a href="https://wa.me/5350994365" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-[#46A040] hover:border-[#46A040] transition-colors">
                        <x-icon name="message-circle" class="w-5 h-5" />
                    </a>
                    <a href="mailto:tecnoelectronicasurl@gmail.com" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-[#46A040] hover:border-[#46A040] transition-colors">
                        <x-icon name="mail" class="w-5 h-5" />
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-bold uppercase tracking-widest text-white mb-6">Categorías</h3>
                <ul class="space-y-4">
                    @foreach(\App\Models\Category::active()->orderBy('name')->take(5)->get() as $cat)
                    <li><a href="/tienda/{{ $cat->slug }}" class="text-white/60 hover:text-[#46A040] transition-colors text-sm font-medium">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-bold uppercase tracking-widest text-white mb-6">Información Legal</h3>
                <ul class="space-y-4">
                    <li><a href="/terminos-y-condiciones" class="text-white/60 hover:text-[#46A040] transition-colors text-sm font-medium">Términos y Condiciones</a></li>
                    <li><a href="/condiciones-de-venta" class="text-white/60 hover:text-[#46A040] transition-colors text-sm font-medium">Condiciones de Venta</a></li>
                    <li><a href="/plazos-de-entrega" class="text-white/60 hover:text-[#46A040] transition-colors text-sm font-medium">Plazos de Entrega</a></li>
                    <li><a href="/politica-de-devoluciones" class="text-white/60 hover:text-[#46A040] transition-colors text-sm font-medium">Política de Devoluciones</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-bold uppercase tracking-widest text-white mb-6">Contacto</h3>
                <ul class="space-y-6">
                    <li class="flex items-start gap-4">
                        <x-icon name="mail" class="w-5 h-5 text-[#46A040] mt-0.5" />
                        <div class="flex flex-col">
                            <span class="text-xs text-white/40 uppercase font-bold tracking-widest mb-1">Correo Electrónico</span>
                            <a href="mailto:tecnoelectronicasurl@gmail.com" class="text-white/80 hover:text-[#46A040] transition-colors text-sm font-medium">tecnoelectronicasurl@gmail.com</a>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <x-icon name="phone" class="w-5 h-5 text-[#46A040] mt-0.5" />
                        <div class="flex flex-col">
                            <span class="text-xs text-white/40 uppercase font-bold tracking-widest mb-1">WhatsApp</span>
                            <a href="https://wa.me/5350994365" target="_blank" rel="noopener noreferrer" class="text-white/80 hover:text-[#46A040] transition-colors text-sm font-medium">+53 50994365</a>
                            <a href="https://wa.me/5350927120" target="_blank" rel="noopener noreferrer" class="text-white/80 hover:text-[#46A040] transition-colors text-sm font-medium">+53 50927120</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-white/10 flex flex-col items-center justify-center text-center">
            <p class="text-xs text-white/40 font-medium">&copy; {{ date('Y') }} Tecnoelectronica SURL. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
