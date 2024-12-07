@extends ('layout.plantilla')

@section ('contenido')

<style>
        /* Estilo personalizado para el botón del dropdown */
.navlink{
    color: white;
}

/*final de dorpdown*/
.btn{
    font-weight: bold;
      font-family: "Roboto", sans-serif;
      font-size:10px;
      text-transform: uppercase;
      outline: 0;
      width: 12%;
      padding: 15px;
      text-align: center;
      font-weight: bolder;
      color: #110d17;
      background: #f2fbf3;
      border: 2px solid #3f305c;
      border-radius: 10px;
      position: relative;
      left: 1000px;
      top:-130px;
}

.btn:hover,.btn:active,.btn:focus {
      transition: 1s all ease-in-out;
      transform: scale(0.91,0.91);
      box-shadow: 0px 0px 10px #eeeaf4;
      background: #c3efcb;
      color: #110d17;
      border: 3px solid #110d17;
      border-radius: 10px;
    }
    .container {

            

            align-items: center; /* Alinea el contenido verticalmente al centro */
            
        }
    </style>

<div class="container">
    <img src="{{asset('img/Russo.png')}}" height="200">

    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn">Cerrar Sesión</button>
    </form>


</div>

<nav class="nav">
    <ul class="list">

        <li class="list__item">
            <div class="list__button">
                <img src="{{asset('icons/dashboard.svg')}}" class="list__img">
                <a href="#" class="nav__link">Inicio</a>
            </div>
        </li>


        <li class="list__item list__item--click">
            <div class="list__button list__button--click">
                <img src="{{asset('icons/productos.svg')}}" class="list__img">
                <a class="nav__link">Productos</a>
                <img src="{{asset('icons/arrow.svg')}}" class="list__arrow">
            </div>

            <ul class="list__show">
                <li class="list__inside">
                    <a href="{{ route('categorias.index') }}" class="nav__link nav__link--inside">Categorias</a>
                </li>

                <li class="list__inside">
                    <a href="{{ route('productos.index') }}" class="nav__link nav__link--inside">Crear Producto</a>
                </li>
            </ul>

        </li>

        <li class="list__item list__item--click">
            <div class="list__button list__button--click">
                <img src="{{asset('icons/compras.svg')}}" class="list__img">
                <a class="nav__link">Compras</a>
                <img src="{{asset('icons/arrow.svg')}}" class="list__arrow">
            </div>

            <ul class="list__show">

                <li class="list__inside">
                    <a href="{{ route('compras.crear') }}" class="nav__link nav__link--inside">Ingresar compra</a>
                </li>

                <li class="list__inside">
                    <a href="{{ route('compras.index') }}" class="nav__link nav__link--inside">listado de compra</a>
                </li>

            </ul>

        </li>


        <li class="list__item">
            <div class="list__button">
                <img src="{{asset('icons/inventario.svg')}}" class="list__img">
                <a href="{{ route('inventario.index') }}" class="nav__link">Inventario</a>
            </div>
        </li>

        <li class="list__item">
            <div class="list__button">
                <img src="{{asset('icons/customer.svg')}}" class="list__img">
                <a href="{{route('personas.clientes')}}" class="nav__link">Clientes</a>
            </div>
        </li>

        <li class="list__item">
            <div class="list__button">
                <img src="{{asset('icons/proveedor.svg')}}" class="list__img">
                <a href="{{ route('proveedores.index') }}" class="nav__link">Proveedores</a>
            </div>
        </li>

    </ul>
</nav>
@endsection
