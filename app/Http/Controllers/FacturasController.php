<?php

namespace App\Http\Controllers;

use App\Models\exitproduct;
use App\Models\facturas;
use App\Models\Personas;
use App\Models\productos;
use App\Models\salidainventario;
use Illuminate\Http\Request;

class FacturasController extends Controller
{
    // Mostrar listado de facturas
    public function index()
    {
        // Obtener todas las facturas con la relación de personas (clientes)
        $facturas = facturas::with('personas')->get(); 
        return view('facturas.index', compact('facturas'));
    }

    // Mostrar formulario para crear una nueva factura
    public function create()
    {
        // Obtener todos los clientes y productos
        $clientes = Personas::all();
        $productos = productos::all();
        $productosJson = $productos->toJson(); // Convertir productos a formato JSON para JS
        return view('facturas.create', compact('clientes', 'productos', 'productosJson'));
    }

    // Guardar una nueva factura
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'cliente_id' => 'required|exists:personas,id', // Asegúrate de que 'cliente_id' sea el campo correcto
            'precio_neto' => 'required|numeric',
            'iva' => 'required|numeric',
            'descuento' => 'required|numeric',
            'precio_total' => 'required|numeric',
        ]);

        // Crear la nueva factura
        $factura = new facturas();
        $factura->cliente_id = $request->cliente_id; // Asignar el ID del cliente
        $factura->precio_neto = $request->precio_neto;
        $factura->iva = $request->iva;
        $factura->descuento = $request->descuento;
        $factura->precio_total = $request->precio_total;
        $factura->save();

        // Registrar las salidas de inventario
        foreach ($request->productos as $producto) {
            salidainventario::create([
                'factura_id' => $factura->id, // ID de la factura recién creada
                'producto_id' => $producto['producto'], // ID del producto
                'cantidad' => $producto['cantidad'], // Cantidad del producto
            ]);
        }

        // Redirigir o devolver una respuesta
        return redirect()->route('personas.dashboard')->with('success', 'Factura creada exitosamente.');
    }

    // Editar factura (aquí podrías agregar la lógica de edición si es necesario)
    public function edit(facturas $facturas)
    {
        return view('facturas.edit', compact('facturas'));
    }

    // Actualizar una factura (lo que falta implementar)
    public function update(Request $request, facturas $facturas)
    {
        // Validar los datos antes de actualizar
        $request->validate([
            'cliente_id' => 'required|exists:personas,id',
            'precio_neto' => 'required|numeric',
            'iva' => 'required|numeric',
            'descuento' => 'required|numeric',
            'precio_total' => 'required|numeric',
        ]);

        // Actualizar la factura
        $facturas->update([
            'cliente_id' => $request->cliente_id,
            'precio_neto' => $request->precio_neto,
            'iva' => $request->iva,
            'descuento' => $request->descuento,
            'precio_total' => $request->precio_total,
        ]);

        return redirect()->route('facturas.index')->with('success_message_update', 'Factura actualizada correctamente');
    }

    // Eliminar factura
    public function destroy(facturas $factura)
    {
        // Eliminar la factura de la base de datos
        $factura->delete();
        return back()->with('success', 'Factura eliminada correctamente');
    }
}
