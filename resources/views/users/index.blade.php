@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[1600px] mx-auto px-4 md:px-8 py-10">
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#46A040] transition-colors mb-2">
                    <x-icon name="chevron-left" class="w-4 h-4" />
                    Volver al perfil
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Usuarios</h1>
                <div class="flex flex-wrap items-center gap-2 mt-2">
                    <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-semibold text-green-700">{{ $totalAdmins }} admin</span>
                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-semibold text-gray-600">{{ $totalCustomers }} clientes</span>
                    @if ($totalInactive > 0)
                        <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-0.5 text-xs font-semibold text-red-700">{{ $totalInactive }} inactivos</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Search + filters -->
        <form method="GET" action="{{ route('users.index') }}" class="mb-6 flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Buscar por nombre o email..."
                   class="flex-1 rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040]" />
            <select name="rol"
                    class="w-36 py-2 px-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none">
                <option value="">Todos los roles</option>
                <option value="admin" {{ request('rol') === 'admin' ? 'selected' : '' }}>Administrador</option>
                <option value="customer" {{ request('rol') === 'customer' ? 'selected' : '' }}>Cliente</option>
            </select>
            <select name="status"
                    class="w-36 py-2 px-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none">
                <option value="active" {{ request('status', 'active') === 'active' ? 'selected' : '' }}>Activos</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactivos</option>
            </select>
            <button type="submit"
                    class="px-4 py-2 text-sm font-semibold text-white bg-[#46A040] rounded-xl hover:bg-[#3d8c38] transition-colors">
                Filtrar
            </button>
            @if (request('search') || request('rol') || request('status') === 'inactive')
                <a href="{{ route('users.index') }}"
                   class="px-4 py-2 text-sm font-semibold text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">
                    Limpiar
                </a>
            @endif
        </form>

        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-sm font-medium text-green-800">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-6 py-4 text-sm font-medium text-red-800">{{ session('error') }}</div>
        @endif

        <section class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm text-gray-700">
                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-50">
                            <th class="py-4 px-6 font-semibold text-gray-900">Usuario</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Email</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Rol</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Pedidos</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Estado</th>
                            <th class="py-4 px-6 font-semibold text-gray-900 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $userItem)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors {{ $userItem->is_active ? '' : 'opacity-60' }}">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-[#ecf8ef] flex items-center justify-center shrink-0">
                                            <span class="text-sm font-bold text-[#46A040]">{{ strtoupper(substr($userItem->name, 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $userItem->name }}</p>
                                            <p class="text-xs text-gray-400">ID: {{ $userItem->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-600">{{ $userItem->email }}</td>
                                <td class="py-4 px-6">
                                    @if ($userItem->isAdmin())
                                        <span class="inline-flex items-center rounded-full bg-[#ecf8ef] px-3 py-1 text-xs font-semibold text-[#23612d]">Administrador</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">Cliente</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-gray-600">{{ $userItem->orders_count }}</td>
                                <td class="py-4 px-6">
                                    @if ($userItem->is_active)
                                        <span class="inline-flex items-center rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">Activo</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">Inactivo</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('users.show', $userItem) }}"
                                           class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 hover:text-gray-800 transition-colors">
                                            <x-icon name="eye" class="w-3.5 h-3.5" />
                                            Ver
                                        </a>
                                        <form action="{{ route('users.toggleActive', $userItem) }}" method="POST"
                                              onsubmit="return confirm('{{ $userItem->is_active ? '¿Desactivar la cuenta de ' . $userItem->name . '?' : '¿Activar la cuenta de ' . $userItem->name . '?' }}')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold {{ $userItem->is_active ? 'text-red-700 bg-red-50 hover:bg-red-100' : 'text-green-700 bg-green-50 hover:bg-green-100' }} transition-colors">
                                                <x-icon name="{{ $userItem->is_active ? 'trash' : 'check-circle' }}" class="w-3.5 h-3.5" />
                                                {{ $userItem->is_active ? 'Desactivar' : 'Activar' }}
                                            </button>
                                        </form>
                                        <form action="{{ route('users.toggleRole', $userItem) }}" method="POST"
                                              onsubmit="return confirm('{{ $userItem->isAdmin() ? '¿Quitar rol de administrador a ' . $userItem->name . '?' : '¿Hacer administrador a ' . $userItem->name . '?' }}')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold {{ $userItem->isAdmin() ? 'text-amber-700 bg-amber-50 hover:bg-amber-100' : 'text-green-700 bg-green-50 hover:bg-green-100' }} transition-colors">
                                                <x-icon name="users" class="w-3.5 h-3.5" />
                                                {{ $userItem->isAdmin() ? 'Quitar admin' : 'Hacer admin' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-16 text-center text-gray-400">
                                    <x-icon name="users" class="w-10 h-10 mx-auto mb-3 text-gray-300" />
                                    <p class="font-medium">No hay usuarios registrados</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($users->hasPages())
                <div class="border-t border-gray-100 px-6 py-4">
                    {{ $users->links() }}
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
