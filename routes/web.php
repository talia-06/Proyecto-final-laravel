<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedoresController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\Auth\RegisterController;

// Ruta para mostrar el formulario de registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');



Route::get('/', [PersonasController::class, 'index'])->name('personas.index');


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [PersonasController::class, 'dashboard'])->name('personas.dashboard');

    Route::get('/pdf/{id}', [PersonasController::class, 'pdf'])->name('personas.pdf');
    Route::get('/pdfTodos', [PersonasController::class, 'pdfTodos'])->name('personas.pdfTodos');

    Route::get('/clientes', [PersonasController::class, 'clientes'])->name('personas.clientes');
    Route::get('/create', [PersonasController::class, 'create'])->name('personas.create');
    Route::post('/store', [PersonasController::class, 'store'])->name('personas.store');
    Route::get('personas/{persona}/edit', [PersonasController::class, 'edit'])->name('personas.edit');
    Route::put('personas/{persona}', [PersonasController::class, 'update'])->name('personas.update');
    Route::get('personas/{persona}', [PersonasController::class, 'show'])->name('personas.show');
    Route::delete('Personas/{id}', [PersonasController::class, 'destroy'])->name('personas.destroy');

    Route::get('/categoria', [CategoriaController::class, 'categoria'])->name('categorias.index');
    Route::get('/categoria/crear', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/storeCategoria', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categoria/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categoria/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categoria/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

    Route::get('/producto', [ProductosController::class, 'producto'])->name('productos.index');
    Route::get('/producto/crear', [ProductosController::class, 'create'])->name('productos.create');
    Route::post('/storeProducto', [ProductosController::class,'store'])->name('productos.store');
    Route::get('/producto/{productos}/edit', [ProductosController::class, 'edit'])->name('productos.edit');
    Route::put('/producto/{productos}', [ProductosController::class, 'update'])->name('productos.update');
    Route::delete('/producto/{id}', [ProductosController::class, 'destroy'])->name('productos.destroy');

    Route::get('/proveedores', [ProveedoresController::class, 'index'])->name('proveedores.index');
    Route::get('/proveedores/crear', [ProveedoresController::class, 'create'])->name('proveedores.create');
    Route::post('/storeProveedor', [ProveedoresController::class,'store'])->name('proveedores.storeProveedor');
    Route::get('/proveedores/{proveedores}/edit', [ProveedoresController::class, 'edit'])->name('proveedores.edit');
    Route::put('/proveedores/{proveedores}', [ProveedoresController::class, 'update'])->name('proveedores.updateProveedor');
    Route::delete('/proveedores/{id}', [ProveedoresController::class, 'destroy'])->name('proveedores.destroyProveedor');

    Route::get('/compras', [ComprasController::class, 'index'])->name('compras.index');
    Route::get('/compras/crear', [ComprasController::class, 'create'])->name('compras.crear');
    Route::post('/compras/guardar', [ComprasController::class, 'store'])->name('compras.guardar');

    Route::get('/facturas', [FacturasController::class, 'index'])->name('facturas.index');
    Route::get('/facturas/crear', [FacturasController::class, 'create'])->name('facturas.crear');
    Route::post('/facturas/guardar', [FacturasController::class, 'store'])->name('facturas.guardar');
    Route::get('/facturas/editar', [FacturasController::class, 'edit'])->name('facturas.editar');
    Route::put('/facturas/editar/guardar', [FacturasController::class, 'update'])->name('facturas.actualizar');
    Route::delete('/facturas/{id}', [FacturasController::class, 'destroy'])->name('facturas.eliminar');

    Route::get('/inventario', [ProductosController::class, 'inventario'])->name('inventario.index');


});
Auth::routes();

