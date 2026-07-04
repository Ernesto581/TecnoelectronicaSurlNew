<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home');
Route::view('/login', 'pages.login');
Route::view('/registro', 'pages.registro');
Route::view('/cuenta', 'pages.cuenta');
Route::view('/customer', 'pages.customer');
Route::view('/admin', 'pages.admin');
Route::view('/admin/products', 'pages.admin-products');
Route::view('/admin/products/new', 'pages.admin-products-new');
Route::view('/admin/categories', 'pages.admin-categories');

Route::get('/admin/products/{id}', function () {
    return view('pages.admin-products-edit');
});

Route::view('/tienda', 'pages.tienda');

Route::get('/tienda/{categoria}', function ($categoria) {
    return view('pages.tienda-categoria', ['categoria' => $categoria]);
});

Route::get('/tienda/producto/{id}', function ($id) {
    return view('pages.tienda-producto', ['id' => $id]);
});

Route::view('/servicio-domicilio', 'pages.servicio-domicilio');
Route::view('/quienes-somos', 'pages.quienes-somos');
