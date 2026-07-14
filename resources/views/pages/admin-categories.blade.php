@extends('layouts.app')

@section('content')
@php
$icons = ['tv', 'sun', 'code', 'shirt', 'shopping-basket', 'house', 'home', 'coffee', 'zap', 'package', 'truck', 'users', 'leaf', 'printer', 'star', 'heart', 'clock', 'map-pin', 'shield-check', 'shopping-bag', 'dumbbell', 'target', 'wrench', 'map', 'info', 'check-circle', 'package-check', 'phone', 'mail', 'message-circle'];
@endphp
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[1000px] mx-auto px-4 md:px-8 py-10">
        <div class="mb-8">
            <a href="/admin" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1 mb-6">
                <x-icon name="chevron-left" class="w-4 h-4" />
                Volver al panel
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Categorías</h1>
            <p class="text-gray-600 mt-2">Gestiona las categorías de productos.</p>
        </div>

        @if(session('success'))
        <div class="mb-6 px-5 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="mb-6 px-5 py-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm font-medium">{{ session('error') }}</div>
        @endif

        <div class="grid gap-8 lg:grid-cols-[1fr_1.5fr]">
            <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Nueva categoría</h2>
                <form action="/admin/categories" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre</label>
                        <input type="text" name="name" required value="{{ old('name') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm" placeholder="Ej: Electrónica" />
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div x-data="{ icon: '{{ old('icon', 'tv') }}', open: false }">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Icono</label>
                        <button type="button" @click="open = !open" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] outline-none text-sm bg-white">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            <span x-text="icon" class="text-gray-700"></span>
                            <x-icon name="chevron-down" class="w-4 h-4 text-gray-400 ml-auto" />
                        </button>
                        <input type="hidden" name="icon" x-model="icon" />
                        <div x-show="open" @click.outside="open = false" class="mt-2 flex flex-wrap gap-1 p-2 bg-white border border-gray-200 rounded-xl shadow-lg max-w-[260px]">
                            @foreach($icons as $ic)
                            <button type="button" @click="icon = '{{ $ic }}'; open = false" :class="icon === '{{ $ic }}' ? 'ring-2 ring-[#46A040] bg-[#46A040]/10' : 'hover:bg-gray-100'" class="w-7 h-7 rounded-md flex items-center justify-center transition-colors shrink-0">
                                <x-icon name="{{ $ic }}" class="w-3.5 h-3.5 text-gray-600" />
                            </button>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Imagen de fondo</label>
                        <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-[#46A040] file:text-white file:font-semibold file:text-sm hover:file:bg-[#3d8c38]" />
                        @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Descripción</label>
                        <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] focus:border-transparent outline-none text-sm resize-none">{{ old('description') }}</textarea>
                    </div>
                    <button type="submit" class="w-full px-5 py-3 bg-[#46A040] text-white font-semibold rounded-xl hover:bg-[#3d8c38] transition-colors">Crear categoría</button>
                </form>
            </section>

            <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Categorías existentes</h2>
                <div class="space-y-3" x-data="{ editing: null }">
                    @forelse($categories as $cat)
                    <div class="rounded-2xl border border-gray-100 p-4">
                        <template x-if="editing !== {{ $cat->id }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center overflow-hidden">
                                        @if($cat->image)
                                        <img src="{{ $cat->image }}" alt="" class="w-full h-full object-cover" />
                                        @else
                                        <x-icon name="{{ $cat->icon ?? 'tv' }}" class="w-5 h-5 text-gray-600" />
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $cat->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $cat->products_count }} productos · /{{ $cat->slug }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button @click="editing = {{ $cat->id }}" class="px-3 py-1.5 text-xs font-semibold text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">Editar</button>
                                    <form action="/admin/categories/{{ $cat->id }}" method="POST" onsubmit="return confirm('¿Eliminar esta categoría?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </template>
                        <template x-if="editing === {{ $cat->id }}">
                            <form action="/admin/categories/{{ $cat->id }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nombre</label>
                                    <input type="text" name="name" value="{{ $cat->name }}" required class="w-full px-3 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] outline-none text-sm" />
                                </div>
                                <div x-data="{ icon: '{{ $cat->icon ?? 'tv' }}', open: false }" class="relative">
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Icono</label>
                                    <button type="button" @click="open = !open" class="w-full flex items-center gap-2 px-3 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] outline-none text-sm bg-white">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                                        <span x-text="icon" class="text-gray-600 text-xs"></span>
                                        <x-icon name="chevron-down" class="w-3 h-3 text-gray-400 ml-auto" />
                                    </button>
                                    <input type="hidden" name="icon" x-model="icon" />
                                    <div x-show="open" @click.outside="open = false" class="mt-1 flex flex-wrap gap-1 p-2 bg-white border border-gray-200 rounded-xl shadow-lg absolute z-20 max-w-[240px]">
                                        @foreach($icons as $ic)
                                        <button type="button" @click="icon = '{{ $ic }}'; open = false" :class="icon === '{{ $ic }}' ? 'ring-2 ring-[#46A040] bg-[#46A040]/10' : 'hover:bg-gray-100'" class="w-6 h-6 rounded-md flex items-center justify-center transition-colors shrink-0">
                                            <x-icon name="{{ $ic }}" class="w-3 h-3 text-gray-600" />
                                        </button>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Imagen</label>
                                    @if($cat->image)
                                    <div class="mb-2 flex items-center gap-2">
                                        <img src="{{ $cat->image }}" alt="" class="w-12 h-12 rounded-lg object-cover border" />
                                        <span class="text-xs text-gray-400">Imagen actual</span>
                                    </div>
                                    @endif
                                    <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" class="w-full text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:bg-[#46A040] file:text-white file:font-semibold file:text-xs" />
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Descripción</label>
                                    <textarea name="description" rows="2" class="w-full px-3 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#46A040] outline-none text-sm resize-none">{{ $cat->description }}</textarea>
                                </div>
                                <div class="flex items-center gap-2 pt-1">
                                    <button type="submit" class="px-4 py-2 bg-[#46A040] text-white text-xs font-semibold rounded-xl hover:bg-[#3d8c38] transition-colors">Guardar</button>
                                    <button type="button" @click="editing = null" class="px-4 py-2 text-gray-600 text-xs font-medium rounded-xl hover:bg-gray-100 transition-colors">Cancelar</button>
                                </div>
                            </form>
                        </template>
                    </div>
                    @empty
                    <p class="text-center text-gray-400 py-4">No hay categorías creadas.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</div>
@endsection