@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[1000px] mx-auto px-4 md:px-8 py-10">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Mi perfil</h1>
            <p class="text-gray-600 mt-1">{{ $user->email }}
                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 ml-2 text-xs font-semibold
                    {{ $user->isAdmin() ? 'text-[#23612d] bg-[#ecf8ef]' : 'text-gray-600 bg-gray-100' }}">
                    {{ $user->isAdmin() ? 'Administrador' : 'Cliente' }}
                </span>
            </p>
        </div>

        @if (session('status') && session('status') !== 'profile-updated' && session('status') !== 'password-updated')
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-sm font-medium text-green-800">
                {{ session('status') }}
            </div>
        @endif

        @if ($user->isAdmin())
            <div class="grid gap-4 sm:grid-cols-4 mb-8">
                <section class="bg-gradient-to-r from-[#ecf8ef] to-[#d9f2da] rounded-3xl border border-[#46A040]/20 shadow-sm p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-[#46A040] flex items-center justify-center shrink-0">
                                <x-icon name="package" class="w-6 h-6 text-white" />
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Gestion de productos</h2>
                                <p class="text-sm text-gray-600">Catalogo e inventario.</p>
                            </div>
                        </div>
                        <a href="{{ route('products.index') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white bg-[#46A040] rounded-full hover:bg-[#3d8c38] transition-colors shrink-0">
                            <x-icon name="package" class="w-4 h-4" />
                            Administrar productos
                        </a>
                    </div>
                </section>

                <section class="bg-gradient-to-r from-[#ecf8ef] to-[#d9f2da] rounded-3xl border border-[#46A040]/20 shadow-sm p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-[#46A040] flex items-center justify-center shrink-0">
                                <x-icon name="users" class="w-6 h-6 text-white" />
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Gestion de usuarios</h2>
                                <p class="text-sm text-gray-600">Cuentas y historial de pedidos.</p>
                            </div>
                        </div>
                        <a href="{{ route('users.index') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white bg-[#46A040] rounded-full hover:bg-[#3d8c38] transition-colors shrink-0">
                            <x-icon name="users" class="w-4 h-4" />
                            Ver usuarios
                        </a>
                    </div>
                </section>

                <section class="bg-gradient-to-r from-[#ecf8ef] to-[#d9f2da] rounded-3xl border border-[#46A040]/20 shadow-sm p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-[#46A040] flex items-center justify-center shrink-0">
                                <x-icon name="package-check" class="w-6 h-6 text-white" />
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Gestion de pedidos</h2>
                                <p class="text-sm text-gray-600">Historial y seguimiento.</p>
                            </div>
                        </div>
                        <a href="{{ route('orders.index') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white bg-[#46A040] rounded-full hover:bg-[#3d8c38] transition-colors shrink-0">
                            <x-icon name="package-check" class="w-4 h-4" />
                            Ver pedidos
                        </a>
                    </div>
                </section>

                <section class="bg-gradient-to-r from-[#ecf8ef] to-[#d9f2da] rounded-3xl border border-[#46A040]/20 shadow-sm p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-[#46A040] flex items-center justify-center shrink-0">
                                <x-icon name="shopping-basket" class="w-6 h-6 text-white" />
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Categorías</h2>
                                <p class="text-sm text-gray-600">Organización del catálogo.</p>
                            </div>
                        </div>
                        <a href="{{ route('categories.index') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white bg-[#46A040] rounded-full hover:bg-[#3d8c38] transition-colors shrink-0">
                            <x-icon name="shopping-basket" class="w-4 h-4" />
                            Gestionar
                        </a>
                    </div>
                </section>
            </div>
        @endif

        <div class="grid gap-8 lg:grid-cols-2">
            <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-[#ecf8ef] flex items-center justify-center">
                            <x-icon name="user" class="w-5 h-5 text-[#46A040]" />
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Informacion de la cuenta</h2>
                            <p class="text-sm text-gray-500">Actualiza tu nombre y direccion de correo.</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Nombre</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                   class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('name') border-red-300 @enderror"
                                   required autocomplete="name" />
                            @error('name')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('email') border-red-300 @enderror"
                                   required autocomplete="username" />
                            @error('email')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4 pt-2">
                            <button type="submit"
                                    class="px-6 py-3 text-sm font-semibold text-white bg-[#46A040] rounded-full hover:bg-[#3d8c38] transition-colors">
                                Guardar cambios
                            </button>
                            @if (session('status') === 'profile-updated')
                                <p class="text-sm font-medium text-green-700">Guardado.</p>
                            @endif
                        </div>
                    </form>
                </section>

            <div class="flex flex-col gap-8">
                <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-[#ecf8ef] flex items-center justify-center">
                            <x-icon name="lock" class="w-5 h-5 text-[#46A040]" />
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Cambiar contraseña</h2>
                            <p class="text-sm text-gray-500">Usa una contraseña larga y segura.</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                        @csrf
                        @method('put')

                        <div>
                            <label for="current_password" class="block text-sm font-semibold text-gray-900 mb-2">Contraseña actual</label>
                            <input type="password" id="current_password" name="current_password"
                                   class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('current_password', 'updatePassword') border-red-300 @enderror"
                                   autocomplete="current-password" />
                            @error('current_password', 'updatePassword')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-900 mb-2">Nueva contraseña</label>
                            <input type="password" id="password" name="password"
                                   class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('password', 'updatePassword') border-red-300 @enderror"
                                   autocomplete="new-password" />
                            @error('password', 'updatePassword')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-900 mb-2">Confirmar contraseña</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('password_confirmation', 'updatePassword') border-red-300 @enderror"
                                   autocomplete="new-password" />
                            @error('password_confirmation', 'updatePassword')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4 pt-2">
                            <button type="submit"
                                    class="px-6 py-3 text-sm font-semibold text-[#46A040] bg-[#ecf8ef] rounded-full hover:bg-[#d9f2da] transition-colors">
                                Cambiar contraseña
                            </button>
                            @if (session('status') === 'password-updated')
                                <p class="text-sm font-medium text-green-700">Contraseña actualizada.</p>
                            @endif
                        </div>
                    </form>
                </section>

                <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                            <x-icon name="sliders" class="w-5 h-5 text-gray-500" />
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Acciones de cuenta</h2>
                            <p class="text-sm text-gray-500">Gestiona tu sesion y datos personales.</p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 text-sm font-semibold text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">
                                <x-icon name="log-out" class="w-4 h-4" />
                                Cerrar sesión
                            </button>
                        </form>
                        <button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                            class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 text-sm font-semibold text-red-700 bg-red-50 rounded-xl hover:bg-red-100 transition-colors">
                            <x-icon name="trash-2" class="w-4 h-4" />
                            Eliminar mi cuenta
                        </button>
                    </div>
                </section>
            </div>
        </div>

        @php
            $pedidos = $user->orders()->placed()->withCount('items')->latest()->take(5)->get();
        @endphp

        @if ($pedidos->isNotEmpty())
            <div class="mt-8 bg-white rounded-3xl border border-gray-200 shadow-sm p-6 md:p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-[#ecf8ef] flex items-center justify-center">
                            <x-icon name="package-check" class="w-5 h-5 text-[#46A040]" />
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Mis pedidos</h2>
                            <p class="text-sm text-gray-500">Últimos pedidos realizados.</p>
                        </div>
                    </div>
                    <a href="{{ route('pedidos.index') }}"
                       class="text-sm font-semibold text-[#46A040] hover:underline">
                        Ver todos
                    </a>
                </div>

                <div class="divide-y divide-gray-100">
                    @foreach ($pedidos as $pedido)
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 py-4">
                            <div class="flex items-center gap-4 min-w-0">
                                <span class="text-sm font-bold text-gray-900 shrink-0">#{{ $pedido->id }}</span>
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold shrink-0
                                    @switch($pedido->status)
                                        @case(App\Enums\OrderStatus::Pending) bg-amber-50 text-amber-700 @break
                                        @case(App\Enums\OrderStatus::Shipped) bg-purple-50 text-purple-700 @break
                                        @case(App\Enums\OrderStatus::Delivered) bg-green-50 text-green-700 @break
                                        @case(App\Enums\OrderStatus::Cancelled) bg-red-50 text-red-700 @break
                                        @default bg-gray-50 text-gray-700
                                    @endswitch
                                ">
                                    {{ ucfirst($pedido->status->value) }}
                                </span>
                                <span class="text-sm text-gray-400 truncate">
                                    {{ $pedido->created_at->format('d/m/Y') }} &middot; {{ $pedido->items_count }} {{ $pedido->items_count === 1 ? 'item' : 'items' }}
                                </span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-sm font-bold text-gray-900">${{ number_format($pedido->total, 2) }}</span>
                                <a href="{{ route('pedidos.show', $pedido) }}"
                                   class="text-xs font-semibold text-[#46A040] hover:underline">
                                    Ver detalle
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-semibold text-gray-900">Eliminar cuenta permanentemente</h2>
        <p class="mt-2 text-sm text-gray-600">Todos tus datos seran eliminados. Introduce tu contraseña para confirmar.</p>

        <div class="mt-6">
            <label for="delete_password" class="block text-sm font-semibold text-gray-900 mb-2">Contraseña</label>
            <input type="password" id="delete_password" name="password"
                   class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:border-red-400"
                   placeholder="Tu contraseña" />
            @error('password', 'userDeletion')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <button type="button" x-on:click="$dispatch('close')"
                    class="px-5 py-3 text-sm font-semibold text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition-colors">
                Cancelar
            </button>
            <button type="submit"
                    class="px-5 py-3 text-sm font-semibold text-white bg-red-600 rounded-full hover:bg-red-700 transition-colors">
                Eliminar cuenta
            </button>
        </div>
    </form>
</x-modal>
@endsection
