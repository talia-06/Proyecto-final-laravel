@extends('layout/plantilla')

@section('tituloPagina', 'Editar Registro')

@section('contenido')
<style>
    .card{
        background: #e0f8e4;
    backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rbga(0, 0, 0, 0.5);
    border: 2px solid #ffffff;
    }
    .btn{
    font-weight: bold;
      font-family: "Roboto", sans-serif;
      font-size:10px;
      text-transform: uppercase;
      outline: 0;
      width: auto;
      padding: 15px;
      text-align: center;
      font-weight: bolder;
      color: #110d17;
      background:  #c3efcb;
      border: 2px solid #3f305c;
      border-radius: 10px;
      
}

.btn:hover{
      transition: 1s all ease-in-out;
      transform: scale(0.91,0.91);
      box-shadow: 0px 0px 10px #eeeaf4;
      background: #5eca73;
      color: #110d17;
      border: 3px solid #110d17;
      border-radius: 10px;
    }
    p{
        color:black;
    }
</style>
<div class="card mt-5" style="width: 100%;">
    <div class="card-body">
        <h5 class="card-tittle">CAMBIAR INFORMACION DE PERSONA</h5>
        <div class="container">
            <form action="{{route('personas.update', $persona)}}" method="POST" class="mt-5"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">N° Cedula</label>
                    <input type="text" class="form-control form-control-sm" placeholder="N° Cedula" name="dni"
                        value="{{$persona->dni}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nombres</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Nombres" name="nombre"
                        value="{{$persona->nombre}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">1er Apellido</label>
                    <input type="text" class="form-control form-control-sm" placeholder="1er apellido" name="paterno"
                        value="{{$persona->paterno}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">2do Apellido</label>
                    <input type="text" class="form-control form-control-sm" placeholder="2do apellido" name="materno"
                        value="{{$persona->materno}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Fecha de nacimiento</label>
                    <input type="date" class="form-control form-control-sm" placeholder="Fecha de nacimiento"
                        name="Fnacimiento" value="{{$persona->fecha_nacimiento}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Edad</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Edad" name="edad"
                        value="{{$persona->edad}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Telefono</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Telefono" name="telefono"
                        value="{{$persona->telefono}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Direccion</label>
                    <input type="text" class="form-control form-control-sm" placeholder="direccion" name="direccion"
                        value="{{$persona->direccion}}">
                </div>
                <div class="mb-3">
                    <label for="imagen">Agregar foto</label><br>
                    <input type="file" name="imagen" id="imagen" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk ms-2"></i>Guardar
                    cambios</button>
                <a href="{{route('personas.dashboard')}}" class="btn btn-success">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
