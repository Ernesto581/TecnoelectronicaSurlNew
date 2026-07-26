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
                <h1 class="text-3xl font-bold text-gray-900">Categorías</h1>
                <div class="flex flex-wrap items-center gap-2 mt-2">
                    <span class="text-sm text-gray-500">{{ $categories->total() }} categorías</span>
                    @if ($trashed > 0)
                        <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-0.5 text-xs font-semibold text-red-700">{{ $trashed }} eliminadas</span>
                    @endif
                </div>
                <p class="text-gray-600 mt-1">{{ $categories->total() }} categorías registradas</p>
            </div>
            <a href="{{ route('categories.create') }}"
               class="inline-flex items-center gap-2 px-5 py-3 text-sm font-semibold text-white bg-[#46A040] rounded-full hover:bg-[#3d8c38] transition-colors">
                <x-icon name="plus" class="w-4 h-4" />
                Nueva categoría
            </a>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-sm font-medium text-green-800">{{ session('success') }}</div>
        @endif

        <section class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm text-gray-700">
                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-50">
                            <th class="py-4 px-6 font-semibold text-gray-900">Categoría</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Descripción</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Productos</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Estado</th>
                            <th class="py-4 px-6 font-semibold text-gray-900 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        @if ($category->image_url)
                                            <img src="{{ Str::startsWith($category->image_url, 'http') ? $category->image_url : Storage::url($category->image_url) }}" alt="{{ $category->name }}"
                                                 class="w-10 h-10 rounded-lg object-cover border border-gray-200" />
                                        @else
                                            <div class="w-10 h-10 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center">
                                                <x-icon name="shopping-basket" class="w-5 h-5 text-gray-400" />
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $category->name }}</p>
                                            <p class="text-xs text-gray-400">{{ $category->slug }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-500 max-w-xs truncate">
                                    {{ $category->description ? Str::limit($category->description, 60) : '—' }}
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-medium text-gray-700">{{ $category->products_count }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    @if ($category->trashed())
                                        <span class="inline-flex items-center rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">Eliminada</span>
                                    @elseif ($category->is_active)
                                        <span class="inline-flex items-center rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">Activa</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">Inactiva</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('categories.show', $category) }}"
                                           class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 hover:text-gray-800 transition-colors">
                                            <x-icon name="eye" class="w-3.5 h-3.5" />
                                            Ver
                                        </a>
                                        @unless ($category->trashed())
                                            <a href="{{ route('categories.edit', $category) }}"
                                               class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold text-amber-700 bg-amber-50 hover:bg-amber-100 transition-colors">
                                                <x-icon name="edit" class="w-3.5 h-3.5" />
                                                Editar
                                            </a>
                                            <button type="button"
                                                    x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-cat-{{ $category->id }}')"
                                                    class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold text-red-700 bg-red-50 hover:bg-red-100 transition-colors">
                                                    <x-icon name="trash" class="w-3.5 h-3.5" />
                                                    Eliminar
                                                </button>
                                            </form>

                                            <x-modal name="confirm-delete-cat-{{ $category->id }}" focusable>
                                                <form method="post" action="{{ route('categories.destroy', $category) }}" class="p-6">
                                                    @csrf
                                                    @method('DELETE')
                                                    <h2 class="text-lg font-semibold text-gray-900">Eliminar categoría</h2>
                                                    <p class="mt-2 text-sm text-gray-600">¿Estás seguro de que deseas eliminar <strong>{{ $category->name }}</strong>? Puedes restaurarla después.</p>
                                                    <div class="mt-6 flex justify-end gap-3">
                                                        <button type="button" x-on:click="$dispatch('close')"
                                                                class="px-5 py-3 text-sm font-semibold text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition-colors">
                                                            Cancelar
                                                        </button>
                                                        <button type="submit"
                                                                class="px-5 py-3 text-sm font-semibold text-white bg-red-600 rounded-full hover:bg-red-700 transition-colors">
                                                            Eliminar
                                                        </button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        @else
                                            <form action="{{ route('categories.restore', $category) }}" method="POST" class="inline-flex">
                                                @csrf
                                                <button type="submit"
                                                        class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold text-green-700 bg-green-50 hover:bg-green-100 transition-colors">
                                                    <x-icon name="refresh-cw" class="w-3.5 h-3.5" />
                                                    Restaurar
                                                </button>
                                            </form>
                                        @endunless
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-16 text-center text-gray-400">
                                    <x-icon name="folder" class="w-10 h-10 mx-auto mb-3 text-gray-300" />
                                    <p class="font-medium">No hay categorías registradas</p>
                                    <p class="text-sm mt-1">Crea la primera categoría para empezar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($categories->hasPages())
                <div class="border-t border-gray-100 px-6 py-4">
                    {{ $categories->links() }}
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
