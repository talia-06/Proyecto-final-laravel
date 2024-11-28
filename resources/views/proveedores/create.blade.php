@extends('layout/plantilla')

@section('tituloPagina', 'Agregar registro')

@section('contenido')
<style>
.card-body{
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
<div class="card-body">

    <form action="{{route('proveedores.storeProveedor')}}" method="post" class="mt-5 border rounded-3 p-5">
        @csrf
        <legend>NUEVO PROVEEDOR</legend>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Nit" name="nit" id="nit" required
                oninput="validarNit(this)">
            <div class="mt-2" id="errorNit" style="color: red; display: none;">SOLO SE PUEDE INGRESAR NUMEROS. <br> No
                se permiten caracteres especiales, signos de puntuacion o letras en este campo.
            </div>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Nombre o razon social" name="nombre" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Direccion" name="direccion" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Telefono" name="telefono" id="nit" required
                oninput="validarTelefono(this)">
            <div class="mt-2" id="errorTelefono" style="color: red; display: none;">SOLO SE PUEDE INGRESAR NUMEROS. <br> No
                se permiten caracteres especiales, signos de puntuacion o letras en este campo.
            </div>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" placeholder="Correo" name="correo" required>
        </div>
        <button type="submit" class="btn btn-success"><i class="fa-regular fa-floppy-disk ms-2"></i>Guardar</button>
        <a href="{{route('proveedores.index')}}" class="btn btn-danger">Cancelar</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function validarNit(input) {
        const errorMessage = document.getElementById('errorNit');
        const invalidChars = /[^0-9]/g;

        if (invalidChars.test(input.value)) {
            errorMessage.style.display = 'block';
            input.value = input.value.replace(invalidChars, '');
        } else {
            errorMessage.style.display = 'none';
        }
    }

</script>

<script>
    function validarTelefono(input) {
        const errorMessage = document.getElementById('errorTelefono');
        const invalidChars = /[^0-9]/g;

        if (invalidChars.test(input.value)) {
            errorMessage.style.display = 'block';
            input.value = input.value.replace(invalidChars, '');
        } else {
            errorMessage.style.display = 'none';
        }
    }

</script>
@endsection
