<?php

namespace App\Http\Controllers;

use App\Models\categorias;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function categoria(Request $request)
    {
        $busqueda = $request->busqueda;

        $query = categorias::query();
    
        if ($busqueda) {
            $query->where('id', 'LIKE', '%'.$busqueda.'%')
                  ->orWhere('nombre', 'LIKE', '%'.$busqueda.'%');
        }
    
        $categoria = $query->latest('id')->paginate(10);
    
        return view('categorias.index', [
            'categoria' => $categoria,
            'busqueda' => $busqueda,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoria = new categorias();

        $categoria->nombre = $request->input('nombre');
        $categoria->save();
        return redirect()->route('categorias.index')->with('success_message', 'La categoria ha sido agregada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(categorias $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(categorias $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, categorias $categoria)
    {
        $categoria->nombre = $request->nombre;
        $categoria->save();
        return redirect()->route('categorias.index')->with('success_message_update', 'Categoria actualizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(categorias $id)
    {
        $id->delete();
        return back()->with('success','success');
    }

    public function verProductosClientes() {
        
    }
}
