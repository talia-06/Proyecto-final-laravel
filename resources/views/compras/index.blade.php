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
        <h5>Listado de facturas de compra</h5>
    </div>

    <div class="card-body">

        <hr>
        <p class="card-text">
            <div class="table table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <th>Numero de compra</th>
                        <th>Proveedor</th>
                        <th>valor neto</th>
                        <th>iva</th>
                        <th>descuento</th>
                        <th>valor total</th>
                    </thead>
                    <tbody>
                        @foreach($compras as $items)
                        <tr>
                            <td>{{$items -> id}}</td>
                            <td>{{$items -> proveedores -> nombre}}</td>
                            <td>$ {{ number_format($items -> precio_costo, 0, ',', '.')}}</td>
                            <td>$ {{ number_format($items -> iva, 0, ',', '.')}}</td>
                            <td>$ {{ number_format($items -> descuento, 0, ',', '.')}}</td>
                            <td>$ {{ number_format($items -> precio_total, 0, ',', '.')}}</td>
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

@section('scripts')
<script>
    $('form[id^="formulario"]').on('submit', function (event) {
        event.preventDefault();
        var form = $(this); // Selecciona el formulario actual
        Swal.fire({
            title: "¿Estás seguro que deseas eliminar este producto?",
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
            text: "El producto fue eliminado correctamente",
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
            title: "Producto agregado correctamente",
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
            title: "Producto actualizado correctamente",
            showConfirmButton: false,
            timer: 1500
        });
    };

</script>
@endif

@endsection

@section('footer')

@endsection
