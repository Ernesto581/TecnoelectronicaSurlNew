@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[1200px] mx-auto px-4 md:px-8 py-10">

        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#46A040] transition-colors mb-2">
                    <x-icon name="chevron-left" class="w-4 h-4" />
                    Volver al perfil
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Consultas</h1>
                <div class="flex flex-wrap items-center gap-2 mt-2">
                    <span class="text-sm text-gray-500">{{ $messages->total() }} mensajes</span>
                    @if ($pending > 0)
                        <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-semibold text-amber-700">{{ $pending }} pendientes</span>
                    @endif
                    @if ($resolved > 0)
                        <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-semibold text-green-700">{{ $resolved }} resueltos</span>
                    @endif
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-sm font-medium text-green-800">{{ session('success') }}</div>
        @endif

        <section class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm text-gray-700">
                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-50">
                            <th class="py-4 px-6 font-semibold text-gray-900">Nombre</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Email</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Mensaje</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Fecha</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Estado</th>
                            <th class="py-4 px-6 font-semibold text-gray-900 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($messages as $msg)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors {{ $msg->is_resolved ? 'opacity-60' : '' }}">
                                <td class="py-4 px-6">
                                    <p class="font-semibold text-gray-900">{{ $msg->name }}</p>
                                </td>
                                <td class="py-4 px-6 text-gray-600">{{ $msg->email }}</td>
                                <td class="py-4 px-6 max-w-xs">
                                    <p class="truncate text-gray-500">{{ $msg->message }}</p>
                                </td>
                                <td class="py-4 px-6 text-gray-500">
                                    {{ $msg->created_at->isoFormat('DD/MM/YYYY') }}
                                    <span class="text-xs text-gray-400 block">{{ $msg->created_at->format('H:i') }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    @if ($msg->is_resolved)
                                        <span class="inline-flex items-center rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">Resuelto</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">Pendiente</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-end gap-2">
                                        <button type="button"
                                                x-data=""
                                                x-on:click="$dispatch('open-modal', 'view-message-{{ $msg->id }}')"
                                                class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 hover:text-gray-800 transition-colors">
                                            <x-icon name="eye" class="w-3.5 h-3.5" />
                                            Ver
                                        </button>
                                        <form action="{{ route('contact.toggle', $msg) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold transition-colors
                                                    {{ $msg->is_resolved
                                                        ? 'text-amber-700 bg-amber-50 hover:bg-amber-100'
                                                        : 'text-green-700 bg-green-50 hover:bg-green-100' }}">
                                                <x-icon name="{{ $msg->is_resolved ? 'refresh-cw' : 'check-circle' }}" class="w-3.5 h-3.5" />
                                                {{ $msg->is_resolved ? 'Reabrir' : 'Resolver' }}
                                            </button>
                                        </form>
                                    </div>

                                    <x-modal name="view-message-{{ $msg->id }}" focusable>
                                        <div class="p-6">
                                            <h2 class="text-lg font-semibold text-gray-900 mb-2">{{ $msg->name }}</h2>
                                            <a href="mailto:{{ $msg->email }}" class="text-sm text-[#46A040] font-medium hover:underline">{{ $msg->email }}</a>
                                            <p class="mt-4 text-gray-700 leading-relaxed">{{ $msg->message }}</p>
                                            <p class="mt-4 text-xs text-gray-400">{{ $msg->created_at->isoFormat('LL [a las] HH:mm') }}</p>
                                            <div class="mt-6 flex justify-end">
                                                <button type="button" x-on:click="$dispatch('close')"
                                                        class="px-5 py-3 text-sm font-semibold text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition-colors">
                                                    Cerrar
                                                </button>
                                            </div>
                                        </div>
                                    </x-modal>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-16 text-center text-gray-400">
                                    <x-icon name="mail" class="w-10 h-10 mx-auto mb-3 text-gray-300" />
                                    <p class="font-medium">No hay mensajes recibidos</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($messages->hasPages())
                <div class="border-t border-gray-100 px-6 py-4">
                    {{ $messages->links() }}
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
