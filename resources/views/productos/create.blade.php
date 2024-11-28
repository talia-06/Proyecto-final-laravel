@extends('layout.plantilla')

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

    <form action="{{route('productos.store')}}" method="post" class="mt-5 border rounded-3 p-5"
        enctype="multipart/form-data">
        @csrf
        <legend>NUEVO PRODUCTO</legend>
        <figure class="photo-preview mb-4">
            <img id="imagePreview" src="{{ asset('img/productos/photo-lg-0.svg') }}" alt="">
        </figure>
        <div class=" mb-4">
            <button type="button" class="upload btn btn-primary"
                onclick="document.getElementById('imagen').click();">Subir foto</button>
            <input type="file" id="imagen" name="imagen" style="display:none;" onchange="previewImage(event);">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Codigo" name="codigo" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Nombres" name="nombre" required>
        </div>
        <div class="mb-3">
            <select name="categoria_id" class="form-control" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <input type="number" class="form-control" placeholder="Precio venta" name="precio_venta" required>
        </div>
        
        <button type="submit" class="btn btn-success"><i class="fa-regular fa-floppy-disk ms-2"></i>Guardar</button>
        <a href="{{route('productos.index')}}" class="btn btn-danger">Cancelar</a>
    </form>
</div>
@endsection
