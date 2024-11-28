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
        <h5>Listado de personas en el sistema</h5>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-lg-5 col-md-5 d-flex">
                <a href="{{route('personas.create')}}" class="btn btn-primary me-3"><i
                        class="fa-solid fa-user-plus ms-2"></i>Agregar nueva persona</a>
            </div>
            <div class="col-lg-5 col-md-5">
                <form action="{{route('personas.dashboard')}}" method="GET" class="d-flex">
                    <input type="search" name="busqueda" class="form-control form-contol-lg me-4" aria-label="Search"
                        aria-describedby="search-addon" placeholder="Buscar..." value="{{ $busqueda }}">
                    @if ($busqueda)
                    <a href="{{ route('personas.dashboard') }}" class="btn btn-danger">Limpiar</a>
                    @else
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    @endif
                </form>
            </div>
            <div class="col-lg-2 col-md-2">
                <a class="btn btn-success btn-sm" href="{{ route('personas.pdfTodos') }}" alt="Imprimir todos">
                    <i class="fa-solid fa-print"></i></a>
            </div>
        </div>



        <hr>
        <p class="card-text">
            <div class="table table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <th>Perfil</th>
                        <th>Nombre</th>
                        <th>1er Apellido</th>
                        <th>2do Apellido</th>
                        <th>Fecha de Nacimiento</th>
                        <th>INFO</th>
                        <th>Editar</th>
                        <th>PDF</th>
                        <th>Eliminar</th>
                    </thead>
                    <tbody>
                        @foreach($personas as $items)
                        <tr>
                            <td><img src="{{asset($items -> imagen)}}" class="img-fluid img-thumbnail" width="60px"
                                    alt=""></td>
                            <td>{{$items -> nombre}}</td>
                            <td>{{$items -> paterno}}</td>
                            <td>{{$items -> materno}}</td>
                            <td>{{$items -> fecha_nacimiento}}</td>
                            <td><a class="btn btn-primary btn-sm" href="{{route('personas.show', $items)}}"><i
                                        class="fa-solid fa-eye"></i></a></td>
                            <td><a class="btn btn-primary btn-sm" href="{{route('personas.edit', $items)}}"><i
                                        class="fa-solid fa-user-pen"></a></i></td>
                            <td><a class="btn btn-primary btn-sm" href="{{ route('personas.pdf', $items) }}">
                                    <i class="fa-solid fa-print"></i></a></td>
                            <form id="formulario{{$loop->index}}" action="{{route('personas.destroy', $items)}}"
                                method="POST">
                                @csrf
                                @method('delete')
                                <td><button type="submit" class="btn btn-danger btn-sm"><i
                                            class="fa-solid fa-trash"></i></button></td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    {{ $personas->appends(['busqueda' => $busqueda])->links() }}
                </div>
            </div>
        </p>
        <a href="{{route('personas.dashboard')}}" class="btn btn-primary me-3">
            <i class="fa-solid fa-arrow-left ms-2"></i></i>Volver</a>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('form[id^="formulario"]').on('submit', function (event) {
        event.preventDefault();
        var form = $(this); // Selecciona el formulario actual
        Swal.fire({
            title: "¿Estás seguro que deseas eliminar esta persona?",
            text: "Al dar clic en confirmar, los datos no se podrán recuperar.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirmar"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

</script>

@if (Session::has('success'))
<script>
    window.onload = function () {
        Swal.fire({
            title: "Confirmado",
            text: "El usuario fue eliminado correctamente",
            icon: "success"
        });
    };

</script>
@endif

@if (session('success_message'))
<script>
    window.onload = function () {
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Usuario agregado correctamente",
            showConfirmButton: false,
            timer: 1500
        });
    };

</script>
@endif

@if (session('success_message_update'))
<script>
    window.onload = function () {
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Usuario actualizado correctamente",
            showConfirmButton: false,
            timer: 1500
        });
    };

</script>
@endif

@endsection

@section('footer')

@endsection
