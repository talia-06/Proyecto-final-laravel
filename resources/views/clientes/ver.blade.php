@extends('layout/plantilla')

@section('tituloPagina', 'Informacio de usuario')

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
        <h5 class="card-title">DATOS DE USUARIO</h5>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                  <img src="{{asset($persona->imagen)}}" alt='{{$persona->imagen}}' class="img-fluid img-thumbnail col-lg-12"
                      alt="..." width="150px">
                </div>
                <div class="col-lg-9">
                  <label for="id">ID</label>
                  <input type="text" name="id" value="{{$persona->id}}" disabled class="bordered col-lg-12 mb-2">
                  <label for="id">N° cedula</label>
                  <input type="text" name="dni" value="{{$persona->dni}}" disabled class="bordered col-lg-12 mb-2">
                  <label for="id">Nombre</label>
                  <input type="text" name="nombre" value="{{$persona->nombre}}" disabled class="bordered col-lg-12 mb-2">
                  <label for="id">1er Apellido</label>
                  <input type="text" name="paterno" value="{{$persona->paterno}}" disabled class="bordered col-lg-12 mb-2">
                  <label for="id">2do Apellido</label>
                  <input type="text" name="materno" value="{{$persona->materno}}" disabled class="bordered col-lg-12 mb-2">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <label for="id">Fecha de nacimiento</label>
                  <input type="text" name="fecha_nacimiento" value="{{$persona->fecha_nacimiento}}" disabled
                      class="bordered col-lg-12 mb-2">
                <label for="id">Edad</label>
                  <input type="text" name="edad" value="{{$persona->edad}}" disabled class="bordered col-lg-12 mb-2">
                <label for="id">Telefono</label>
                  <input type="text" name="telefono" value="{{$persona->telefono}}" disabled class="bordered col-lg-12 mb-2">
                <label for="id">Direccion</label>
                  <input type="text" name="direccion" value="{{$persona->direccion}}" disabled class="bordered col-lg-12 mb-2">
                </div>
            </div>
        </div>
        <a href="{{route('personas.dashboard')}}" class="btn btn-success"><i class="fa-solid fa-rotate-left ms-2"></i>Volver</a>
    </div>
</div>
@endsection
