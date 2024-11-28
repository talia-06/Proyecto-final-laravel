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
        <h5 class="card-tittle">EDITAR PROVEEDOR</h5>
        <div class="container">
            <form action="{{route('proveedores.updateProveedor',  ['proveedores' => $proveedores->id])}}" method="POST" class="mt-5">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nit</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Codigo" name="nit"
                        value="{{$proveedores->nit}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nombre o razon social</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Nombre o razon social" name="nombre"
                        value="{{$proveedores->nombre}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Direccion</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Direccion" name="direccion"
                        value="{{$proveedores->direccion}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Telefono</label>
                    <input type="number" class="form-control form-control-sm" placeholder="Telefono" name="telefono"
                        value="{{$proveedores->telefono}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Correo</label>
                    <input type="email" class="form-control form-control-sm" placeholder="Correo" name="correo"
                        value="{{$proveedores->correo}}">
                </div>
                
                <button type="submit" class="btn btn-success"><i class="fa-regular fa-floppy-disk ms-2"></i>Guardar
                    cambios</button>
                <a href="{{route('proveedores.index')}}" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
