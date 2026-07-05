@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[1600px] mx-auto px-4 md:px-8 py-10">

        @if ($user->isAdmin())
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                    <p class="text-gray-600 mt-1">Panel de administracion de perfil y productos</p>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('profile.products.index') }}"
                       class="inline-flex items-center gap-2 px-5 py-3 text-sm font-semibold text-[#46A040] bg-[#ecf8ef] rounded-full hover:bg-[#d9f2da] transition-colors">
                        <x-icon name="package" class="w-4 h-4" />
                        Gestionar productos
                    </a>
                    <a href="{{ route('profile.products.create') }}"
                       class="inline-flex items-center gap-2 px-5 py-3 text-sm font-semibold text-white bg-[#46A040] rounded-full hover:bg-[#3d8c38] transition-colors">
                        <x-icon name="plus" class="w-4 h-4" />
                        Nuevo producto
                    </a>
                </div>
            </div>
        @else
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Mi perfil</h1>
                <p class="text-gray-600 mt-1">Gestiona tu informacion personal y configura tu cuenta.</p>
            </div>
        @endif

        <div class="grid gap-8 @if ($user->isAdmin()) lg:grid-cols-[1fr_0.8fr] @else lg:grid-cols-1 @endif">
            <div class="space-y-8">
                @if ($user->isAdmin())
                    <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-[#ecf8ef] flex items-center justify-center">
                                <x-icon name="package" class="w-5 h-5 text-[#46A040]" />
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Productos</h2>
                                <p class="text-sm text-gray-500">{{ $products->total() }} productos en el catalogo</p>
                            </div>
                        </div>

                        @if (session('success'))
                            <div class="mb-4 rounded-2xl border border-green-200 bg-green-50 px-5 py-3 text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="overflow-x-auto">
                            <table class="min-w-full text-left text-sm text-gray-700">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="py-3 px-4 font-semibold text-gray-900">Producto</th>
                                        <th class="py-3 px-4 font-semibold text-gray-900">Precio</th>
                                        <th class="py-3 px-4 font-semibold text-gray-900">Stock</th>
                                        <th class="py-3 px-4 font-semibold text-gray-900">Estado</th>
                                        <th class="py-3 px-4 font-semibold text-gray-900 text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                            <td class="py-3 px-4">
                                                <div class="flex items-center gap-3">
                                                    @if ($product->image_url)
                                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                                             class="w-8 h-8 rounded-lg object-cover border border-gray-200" />
                                                    @endif
                                                    <div>
                                                        <p class="font-semibold text-gray-900">{{ $product->name }}</p>
                                                        <p class="text-xs text-gray-400">{{ $product->category?->name ?? 'Sin categoria' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3 px-4">
                                                <span class="font-semibold text-[#046b22]">${{ number_format($product->price, 2) }}</span>
                                            </td>
                                            <td class="py-3 px-4">
                                                <span class="@if ($product->stock <= 0) text-red-600 @elseif ($product->stock <= 5) text-amber-600 @else text-gray-700 @endif font-medium">
                                                    {{ $product->stock }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4">
                                                @if ($product->is_active)
                                                    <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-semibold text-green-700">Activo</span>
                                                @else
                                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-semibold text-gray-600">Inactivo</span>
                                                @endif
                                            </td>
                                            <td class="py-3 px-4">
                                                <div class="flex items-center justify-end gap-1.5">
                                                    <a href="{{ route('profile.products.show', $product) }}"
                                                       class="rounded-full p-2 text-gray-400 hover:text-[#46A040] hover:bg-gray-100 transition-colors"
                                                       title="Ver detalle">
                                                        <x-icon name="eye" class="w-4 h-4" />
                                                    </a>
                                                    <a href="{{ route('profile.products.edit', $product) }}"
                                                       class="rounded-full p-2 text-gray-400 hover:text-amber-600 hover:bg-gray-100 transition-colors"
                                                       title="Editar">
                                                        <x-icon name="edit" class="w-4 h-4" />
                                                    </a>
                                                    <form action="{{ route('profile.products.destroy', $product) }}" method="POST"
                                                          onsubmit="return confirm('Eliminar este producto?')" class="inline-flex">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="rounded-full p-2 text-gray-400 hover:text-red-600 hover:bg-gray-100 transition-colors"
                                                                title="Eliminar">
                                                            <x-icon name="trash" class="w-4 h-4" />
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="py-12 text-center text-gray-400">
                                                <x-icon name="package" class="w-8 h-8 mx-auto mb-2 text-gray-300" />
                                                <p class="font-medium">No hay productos registrados</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if ($products->hasPages())
                            <div class="border-t border-gray-100 pt-4 mt-4">
                                {{ $products->links() }}
                            </div>
                        @endif
                    </section>
                @endif

                <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-[#ecf8ef] flex items-center justify-center">
                            <x-icon name="user" class="w-5 h-5 text-[#46A040]" />
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Informacion de la cuenta</h2>
                            <p class="text-sm text-gray-500">{{ $user->email }}
                                <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 ml-2 text-xs font-semibold
                                    {{ $user->isAdmin() ? 'text-[#23612d] bg-[#ecf8ef]' : 'text-gray-600' }}">
                                    {{ $user->isAdmin() ? 'Administrador' : 'Cliente' }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
            </div>

            <div class="space-y-8">
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

                <section class="bg-white rounded-3xl border border-red-100 shadow-sm p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center">
                            <x-icon name="alert-triangle" class="w-5 h-5 text-red-500" />
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Eliminar cuenta</h2>
                            <p class="text-sm text-gray-500">Esta accion no se puede deshacer.</p>
                        </div>
                    </div>

                    <button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                        class="px-5 py-3 text-sm font-semibold text-red-700 bg-red-50 rounded-full hover:bg-red-100 transition-colors">
                        Eliminar mi cuenta
                    </button>
                </section>
            </div>
        </div>
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
