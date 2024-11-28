<?php

namespace App\Http\Controllers;

use App\Models\proveedores;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;

        $query = proveedores::query();
    
        if ($busqueda) {
            $query->where('nit', 'LIKE', '%'.$busqueda.'%')
                  ->orWhere('nombre', 'LIKE', '%'.$busqueda.'%')
                  ->orWhere('direccion', 'LIKE', '%'.$busqueda.'%')
                  ->orWhere('correo', 'LIKE', '%'.$busqueda.'%')
                  ->orWhereHas('telefono', function ($q) use ($busqueda) {
                      $q->where('nombre', 'LIKE', '%'.$busqueda.'%');
                  });
        }
    
        $proveedores = $query->latest('id')->paginate(10);
    
        return view('proveedores.index', [
            'proveedores' => $proveedores,
            'busqueda' => $busqueda,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $proveedor = new proveedores();
        
        $proveedor->nit = $request->input('nit');
        $proveedor->nombre = $request->input('nombre');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->correo = $request->input('correo');
        $proveedor->save();
        return redirect()->route('proveedores.index')->with('success_message', 'El proveedor ha sido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(proveedores $proveedores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(proveedores $proveedores)
    {
        return view('proveedores.edit', compact('proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, proveedores $proveedores)
    {
        $proveedores->nit = $request->nit;
        $proveedores->nombre = $request->nombre;
        $proveedores->direccion = $request->direccion;
        $proveedores->telefono = $request->telefono;
        $proveedores->correo = $request->correo;
        $proveedores->save();
        return redirect()->route('proveedores.index')->with('success_message_update', 'Proveedor actualizado con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(proveedores $id)
    {
        $id->delete();
        return back()->with('success','success');
    }
}
