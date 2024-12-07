@extends('layout.plantilla')

@section('tituloPagina', 'Crud Laravel 8')

@section('contenido')
<style>
    .card {
        background: #e0f8e4;
        backdrop-filter: blur(20px);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        /* Corrección de 'rbga' a 'rgba' */
        border: 2px solid #ffffff;
    }

    .btn {
        font-weight: bold;
        font-family: "Roboto", sans-serif;
        font-size: 10px;
        text-transform: uppercase;
        outline: 0;
        width: auto;
        padding: 15px;
        text-align: center;
        font-weight: bolder;
        color: #110d17;
        background: #c3efcb;
        border: 2px solid #3f305c;
        border-radius: 10px;
    }

    .btn:hover {
        transition: 1s all ease-in-out;
        transform: scale(0.91, 0.91);
        box-shadow: 0px 0px 10px #eeeaf4;
        background: #5eca73;
        color: #110d17;
        border: 3px solid #110d17;
        border-radius: 10px;
    }

    p {
        color: black;
    }
</style>

<div class="card mt-5">
    <div class="card-header">
        <h5>Lista de facturas</h5>
    </div>

    <div class="card-body">
        <hr>
        <p class="card-text">
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Número de factura</th>
                        <th>Cliente</th>
                        <th>Valor neto</th>
                        <th>IVA</th>
                        <th>Descuento</th>
                        <th>Valor total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($facturas as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->personas->nombre }}</td>
                        <td>$ {{ number_format($item->precio_neto, 0, ',', '.') }}</td>
                        <td>$ {{ number_format($item->iva, 0, ',', '.') }}</td>
                        <td>$ {{ number_format($item->descuento, 0, ',', '.') }}</td>
                        <td>$ {{ number_format($item->precio_total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>
        </p>
        <a href="{{ route('personas.dashboard') }}" class="btn btn-primary me-3">
            <i class="fa-solid fa-arrow-left ms-2"></i> Volver
        </a>
    </div>
</div>
@endsection
@section('scripts')
<script>
    // Confirmación de eliminación con SweetAlert
    document.querySelectorAll('form[id^="formulario"]').forEach((form) => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
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
    });

    // Mensajes de éxito usando SweetAlert
    @if(Session::has('success') || session('success_message') || session('success_message_update'))
    window.onload = function() {
        let icon = "success"; // Por defecto es success
        let title = "";
        let message = "";

        @if(Session::has('success'))
        title = "Confirmado";
        message = "El producto fue eliminado correctamente";
        @elseif(session('success_message'))
        title = "Producto agregado correctamente";
        @elseif(session('success_message_update'))
        title = "Producto actualizado correctamente";
        @endif

        Swal.fire({
            position: "top-end",
            icon: icon,
            title: title,
            showConfirmButton: false,
            timer: 1500
        });
    };
    @endif
</script>
@endsection