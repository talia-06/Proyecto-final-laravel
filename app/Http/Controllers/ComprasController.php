<?php

namespace App\Http\Controllers;

use App\Models\compras;
use App\Models\entradainventario;
use App\Models\productos;
use App\Models\proveedores;
use Illuminate\Http\Request;

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = compras::all();
        return view('compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = proveedores::all();
        $productos = productos::all();
        return view('compras.create', compact('proveedores', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validar los datos recibidos
         $request->validate([
            'precio_neto' => 'required|numeric',
            'iva' => 'required|numeric',
            'descuento' => 'required|numeric',
            'precio_total' => 'required|numeric',
        ]);

        // Crear una nueva factura
        $compra = new compras();
        $compra->numero_factura = $request->numero_factura;
        $compra->proveedor_id = $request->proveedor; // Asumiendo que 'clientes' es el ID del cliente
        $compra->precio_costo = $request->precio_neto;
        $compra->iva = $request->iva;
        $compra->descuento = $request->descuento;
        $compra->precio_total = $request->precio_total;
        $compra->save();

        // Registrar salidas de inventario
        foreach ($request->productos as $producto) {
            entradainventario::create([
                'compra_id' => $compra->id, // ID de la factura que acabamos de crear
                'producto_id' => $producto['producto'], // ID del producto
                'cantidad' => $producto['cantidad'], // Cantidad del producto
            ]);
        }

        // Redirigir o devolver una respuesta
        return redirect()->route('personas.dashboard')->with('success', 'Factura creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(compras $compras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(compras $compras)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, compras $compras)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(compras $compras)
    {
        //
    }
}
