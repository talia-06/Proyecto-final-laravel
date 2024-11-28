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
        <h5>Lista de categorias</h5>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-lg-5 col-md-5 d-flex">
                <a href="{{route('categorias.create')}}" class="btn"><i class="fa-solid fa-list ms-2"></i>Agregar nueva categoria</a>
            </div>
            <div class="col-lg-5 col-md-5">
                <form action="{{route('categorias.index')}}" method="GET" class="d-flex">
                    <input type="text" name="busqueda" class="form-control form-contol-lg me-4" placeholder="Buscar..."
                        value="{{ $busqueda }}">
                    @if ($busqueda)
                    <a href="{{ route('categorias.index') }}" class="btn">Borrar</a>
                    @else
                    <button type="submit" class="btn">Buscar</button>
                    @endif
                </form>
            </div>
        </div>

        <hr>
        <p class="card-text">
            <div class="table table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <th>Nombre</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </thead>
                    <tbody>
                        @foreach($categoria as $items)
                        <tr>
                            <td>{{$items -> nombre}}</td>
                            <td><a class="btn btn-primary btn-sm" href="{{route('categorias.edit', $items)}}"><i
                                        class="fa-solid fa-pen"></a></i></td>
                            <form id="formulario{{$loop->index}}" action="{{route('categorias.destroy', $items)}}"
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
                    {{ $categoria->appends(['busqueda' => $busqueda])->links() }}
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
            title: "¿Estás seguro que deseas eliminar esta categoria?",
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
            text: "La categoria fue eliminada correctamente",
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
            title: "Categoria agregada correctamente",
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
            title: "Categoria actualizada correctamente",
            showConfirmButton: false,
            timer: 1500
        });
    };

</script>
@endif

@endsection

@section('footer')

@endsection
