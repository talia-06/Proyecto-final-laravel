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
        <h5 class="card-tittle">CAMBIAR CATEGORIA</h5>
        <div class="container">
            <form action="{{route('categorias.update',  ['categoria' => $categoria->id])}}" method="POST" class="mt-5">
                @csrf
                @method('put')
                
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nombres</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Nombres" name="nombre"
                        value="{{$categoria->nombre}}">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk ms-2"></i>Guardar</button>
                <a href="{{route('categorias.index')}}" class="btn btn-success">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
