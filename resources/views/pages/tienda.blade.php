@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-surface">
    <x-store-catalog :productsJson="$productsJson" :categories="$categories" :searchQuery="$searchQuery ?? ''" />
</div>
@endsection
