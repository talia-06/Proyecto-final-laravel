<?php

namespace App\Http\Controllers;

use App\Models\productos;
use App\Models\categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function producto(Request $request)
    {
        $busqueda = $request->busqueda;

        $query = productos::query();
    
        if ($busqueda) {
            $query->where('codigo', 'LIKE', '%'.$busqueda.'%')
                  ->orWhere('nombre', 'LIKE', '%'.$busqueda.'%')
                  ->orWhere('precio', 'LIKE', '%'.$busqueda.'%')
                  ->orWhereHas('categoria', function ($q) use ($busqueda) {
                      $q->where('nombre', 'LIKE', '%'.$busqueda.'%');
                  });
        }
    
        $productos = $query->latest('id')->paginate(10);
    
        return view('productos.index', [
            'productos' => $productos,
            'busqueda' => $busqueda,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = categorias::orderBy('nombre', 'asc')->get(); // Carga todass las categorias por orden alfabetico
        return view('productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $producto = new productos();

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $destinoimg = 'img/productos/';
    
            // Obtener el nombre del usuario y agregarlo al nombre de la imagen
            $nombreProducto = $request->input('nombre');
            $nombreArchivo = 'portada_' . $nombreProducto . '.' . $imagen->getClientOriginalExtension();
    
            // Validar si ya existe una imagen con el mismo nombre y eliminarla
            $imagenAnterior = $producto->image;
            if ($imagenAnterior && Storage::exists($imagenAnterior)) {
                Storage::delete($imagenAnterior);
            }
    
            // Mover la nueva imagen al destino con el nuevo nombre
            $uploadSuccess = $imagen->move($destinoimg, $nombreArchivo);
            $producto->img = $destinoimg . $nombreArchivo;
        }
        
        $producto->codigo = $request->input('codigo');
        $producto->nombre = $request->input('nombre');
        $producto->categoria_id = $request->input('categoria_id');
        $producto->precio_venta = $request->input('precio_venta');
        $producto->save();
        return redirect()->route('productos.index')->with('success_message', 'La categoria ha sido agregada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(productos $productos)
    {
        $categorias = categorias::orderBy('nombre', 'asc')->get(); // Cargar todas las categorías por orden alfabetico
        return view('productos.edit', compact('productos', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, productos $productos)
    {
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $destinoimg = 'img/productos/';
    
            // Obtener el nombre del usuario y agregarlo al nombre de la imagen
            $nombreProducto = $request->input('nombre');
            $nombreArchivo = 'portada_' . $nombreProducto . '.' . $imagen->getClientOriginalExtension();
    
            // Validar si ya existe una imagen con el mismo nombre y eliminarla
            $imagenAnterior = $productos->image;
            if ($imagenAnterior && Storage::exists($imagenAnterior)) {
                Storage::delete($imagenAnterior);
            }
    
            // Mover la nueva imagen al destino con el nuevo nombre
            $uploadSuccess = $imagen->move($destinoimg, $nombreArchivo);
            $productos->img = $destinoimg . $nombreArchivo;
        }

        $productos->codigo = $request->codigo;
        $productos->nombre = $request->nombre;
        $productos->categoria_id = $request->categoria_id;
        $productos->precio = $request->precio;
        $productos->save();
        return redirect()->route('productos.index')->with('success_message_update', 'Categoria actualizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(productos $id)
    {
        $id->delete();
        return back()->with('success','success');
    }

    public function inventario() {
        $query = DB::table('inventario_resumen')->get();
        return view('inventario', compact('query'));
    }
}
