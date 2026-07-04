@extends('layouts.app')

@section('content')
<main class="min-h-screen bg-gray-50 pt-28 pb-16">
    <div class="max-w-4xl mx-auto px-4 md:px-8">
        <div x-data="{ activeTab: 'profile' }">
            <div class="mb-8 flex items-start justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Mi Cuenta</h1>
                    <p class="text-gray-500 mt-2">Administra tu perfil, contraseña y carrito de compras</p>
                </div>
                <button class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-red-600 bg-red-50 rounded-full hover:bg-red-100 transition-colors">
                    <x-icon name="log-out" class="w-4 h-4" />
                    Cerrar sesión
                </button>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <nav class="lg:w-64 shrink-0">
                    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-2 flex lg:flex-col gap-1">
                        <button @click="activeTab = 'profile'" :class="activeTab === 'profile' ? 'bg-[#46A040] text-white shadow-md' : 'text-gray-600 hover:bg-gray-50'" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-medium transition-all w-full text-left">
                            <x-icon name="user" class="w-5 h-5" />
                            <span>Mi Perfil</span>
                        </button>
                        <button @click="activeTab = 'password'" :class="activeTab === 'password' ? 'bg-[#46A040] text-white shadow-md' : 'text-gray-600 hover:bg-gray-50'" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-medium transition-all w-full text-left">
                            <x-icon name="lock" class="w-5 h-5" />
                            <span>Contraseña</span>
                        </button>
                        <button @click="activeTab = 'cart'" :class="activeTab === 'cart' ? 'bg-[#46A040] text-white shadow-md' : 'text-gray-600 hover:bg-gray-50'" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-medium transition-all w-full text-left">
                            <x-icon name="shopping-cart" class="w-5 h-5" />
                            <span>Carrito</span>
                            <span x-show="cartCount > 0" :class="activeTab === 'cart' ? 'bg-white/20 text-white' : 'bg-[#46A040] text-white'" class="ml-auto text-xs font-bold px-2 py-0.5 rounded-full" x-text="cartCount"></span>
                        </button>
                    </div>
                </nav>

                <div class="flex-1 min-w-0">
                    {{-- Profile Tab --}}
                    <div x-show="activeTab === 'profile'" class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-full bg-[#ecf8ef] flex items-center justify-center">
                                <x-icon name="user" class="w-6 h-6 text-[#46A040]" />
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Mi Perfil</h2>
                                <p class="text-sm text-gray-500">Información personal de la cuenta</p>
                            </div>
                        </div>
                        <div class="mb-6 p-4 bg-gray-50 rounded-2xl">
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-1">Correo electrónico</label>
                            <p class="text-gray-900 font-medium">usuario@ejemplo.com</p>
                            <p class="text-xs text-gray-400 mt-1">No es posible cambiar el correo electrónico por ahora.</p>
                        </div>
                        <form class="space-y-4">
                            <div>
                                <label for="fullName" class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-1.5">Nombre completo</label>
                                <input id="fullName" type="text" value="Usuario Ejemplo" placeholder="Tu nombre completo" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:ring-2 focus:ring-[#46A040] focus:border-[#46A040] outline-none transition-colors text-gray-900 font-medium" />
                            </div>
                            <button type="submit" class="flex items-center justify-center gap-2 px-6 py-3 bg-[#46A040] text-white font-bold rounded-xl hover:bg-[#3d8c38] transition-colors shadow-lg shadow-[#46A040]/20">
                                <x-icon name="save" class="w-4 h-4" />
                                Guardar cambios
                            </button>
                        </form>
                    </div>

                    {{-- Password Tab --}}
                    <div x-show="activeTab === 'password'" class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-full bg-[#ecf8ef] flex items-center justify-center">
                                <x-icon name="lock" class="w-6 h-6 text-[#46A040]" />
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Cambiar Contraseña</h2>
                                <p class="text-sm text-gray-500">Actualiza tu contraseña de acceso</p>
                            </div>
                        </div>
                        <form class="space-y-4">
                            <div>
                                <label for="currentPassword" class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-1.5">Contraseña actual</label>
                                <input id="currentPassword" type="password" placeholder="••••••••" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:ring-2 focus:ring-[#46A040] focus:border-[#46A040] outline-none transition-colors text-gray-900 font-medium" />
                            </div>
                            <div>
                                <label for="newPassword" class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-1.5">Nueva contraseña</label>
                                <input id="newPassword" type="password" placeholder="••••••••" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:ring-2 focus:ring-[#46A040] focus:border-[#46A040] outline-none transition-colors text-gray-900 font-medium" />
                            </div>
                            <div>
                                <label for="confirmPassword" class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-1.5">Confirmar nueva contraseña</label>
                                <input id="confirmPassword" type="password" placeholder="••••••••" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:ring-2 focus:ring-[#46A040] focus:border-[#46A040] outline-none transition-colors text-gray-900 font-medium" />
                            </div>
                            <button type="submit" class="flex items-center justify-center gap-2 px-6 py-3 bg-[#46A040] text-white font-bold rounded-xl hover:bg-[#3d8c38] transition-colors shadow-lg shadow-[#46A040]/20">
                                <x-icon name="save" class="w-4 h-4" />
                                Cambiar contraseña
                            </button>
                        </form>
                    </div>

                    {{-- Cart Tab --}}
                    <div x-show="activeTab === 'cart'" class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 md:p-8">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-[#ecf8ef] flex items-center justify-center">
                                    <x-icon name="shopping-cart" class="w-6 h-6 text-[#46A040]" />
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">Mi Carrito</h2>
                                    <p class="text-sm text-gray-500">Sin productos</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-center py-16">
                            <x-icon name="shopping-cart" class="w-16 h-16 text-gray-200 mx-auto mb-4" />
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Tu carrito está vacío</h3>
                            <p class="text-gray-500 mb-6">Explora nuestros productos y agrega los que más te gusten</p>
                            <a href="/tienda" class="inline-flex px-6 py-3 bg-[#46A040] text-white font-bold rounded-full hover:bg-[#3d8c38] transition-colors">Ir a la tienda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
