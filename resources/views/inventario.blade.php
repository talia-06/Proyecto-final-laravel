@extends('layout.plantilla')

@section('tituloPagina', 'Crud laravel 8')

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
<div class="card mt-5">
    <div class="card-header">
        <h5>Inventario actual</h5>
    </div>

    <div class="card-body">

        <hr>
        <p class="card-text">
            <div class="table table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <th>Producto</th>
                        <th>Total de entradas</th>
                        <th>Total salidas</th>
                        <th>Existencia actual</th>
                    </thead>
                    <tbody>
                        @foreach($query as $items)
                        <tr>
                            <td>{{$items -> nombre_producto}}</td>
                            <td>{{$items -> total_entradas}}</td>
                            <td>{{$items -> total_salidas}}</td>
                            <td>{{$items -> existencia}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
        </p>
        <a href="{{route('personas.dashboard')}}" class="btn btn-primary me-3">
            <i class="fa-solid fa-arrow-left ms-2"></i></i>Volver</a>
    </div>
</div>
@endsection