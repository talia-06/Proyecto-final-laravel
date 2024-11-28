<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PersonasController extends Controller
{ 
    public function pdfTodos(Personas $persona){
        $persona = Personas::all();
        $pdf = PDF::loadView('pdf.pdfTodos', compact('persona'));
        $pdf->setPaper('letter', 'landscape');
        return $pdf->stream('personas.pdf');
    }
    public function pdf(Personas $persona, $id){
        $persona = Personas::find($id);
        $pdf = PDF::loadView('pdf.pdf', compact('persona'));
        $pdf->setPaper('letter', 'landscape');
        return $pdf->stream('personas.pdf');
    }

    public function index()
    {
        return view('home');
        // Pagina de inicio
    }

    public function dashboard()
    {
        return view('dashboard');
        // Pagina de inicio
    }

    public function clientes(Request $request)
    {
        $busqueda = $request->busqueda;

    $query = Personas::query();

    if ($busqueda) {
        $query->where('DNI', 'LIKE', '%'.$busqueda.'%')
              ->orWhere('nombre', 'LIKE', '%'.$busqueda.'%');
    }

    $personas = $query->latest('id')->paginate(10);

    return view('clientes.clientes', [
        'personas' => $personas,
        'busqueda' => $busqueda,
        ]);
        // Pagina de dashboard
    }

    public function create()
    {
        return view('clientes.agregar');
        // Metodo o al formulario donde agregaremos datos a nuestra BD
    }

    public function store(Request $request)
    {
        // Metodo que nos permitira guardar datos en la BD
        $personas = new personas();

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $destinoimg = 'img/perfil/';
    
            // Obtener el nombre del usuario y agregarlo al nombre de la imagen
            $nombreUsuario = $request->input('nombre');
            $nombreArchivo = 'perfil_' . $nombreUsuario . '.' . $imagen->getClientOriginalExtension();
    
            // Validar si ya existe una imagen con el mismo nombre y eliminarla
            $imagenAnterior = $personas->imagen;
            if ($imagenAnterior && Storage::exists($imagenAnterior)) {
                Storage::delete($imagenAnterior);
            }
    
            // Mover la nueva imagen al destino con el nuevo nombre
            $uploadSuccess = $imagen->move($destinoimg, $nombreArchivo);
            $personas->imagen = $destinoimg . $nombreArchivo;
        }

        $personas->dni = $request->input('dni');
        $personas->nombre = $request->input('nombre');
        $personas->paterno = $request->input('paterno');
        $personas->materno = $request->input('materno');
        $personas->fecha_nacimiento = $request->input('Fnacimiento');
        $personas->edad = $request->input('edad');
        $personas->telefono = $request->input('telefono');
        $personas->direccion = $request->input('direccion');
        $personas->save();
        return redirect()->route('personas.clientes')->with('success_message', 'La persona ha sido agregada exitosamente.');
    }

    public function show(Personas $persona)
    {
        return view('clientes.ver', compact('persona'));
        // Metodo para obtener un registro de la BD
    }

    public function edit(Personas $persona)
    {
        return view('clientes.editar', compact('persona'));
        // Traer dados de la BD y colocarlos en un formulario para despues actualizar
    }

    public function update(Request $request, Personas $persona)
    {
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $destinoimg = 'img/perfil/';
    
            // Obtener el nombre del usuario y agregarlo al nombre de la imagen
            $nombreUsuario = $request->input('nombre');
            $nombreArchivo = 'perfil_' . $nombreUsuario . '.' . $imagen->getClientOriginalExtension();
    
            // Mover la imagen al destino con el nuevo nombre
            $uploadSuccess = $imagen->move($destinoimg, $nombreArchivo);
            $persona->imagen = $destinoimg . $nombreArchivo;
        }

        $persona->dni = $request->dni;
        $persona->nombre = $request->nombre;
        $persona->paterno = $request->paterno;
        $persona->materno = $request->materno;
        $persona->fecha_nacimiento = $request->Fnacimiento;
        $persona->edad = $request->edad;
        $persona->telefono = $request->telefono;
        $persona->direccion = $request->direccion;
        $persona->save();
        return redirect()->route('personas.clientes')->with('success_message_update', 'Persona actualizada con exito.');
        // Metodo para actualizar un registro
    }

    public function destroy(Personas $id)
    {
        // Eliminar un registro de la BD
        $id->delete();
        return back()->with('success','success');
    }
}
