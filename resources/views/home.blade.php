@extends('layout.plantilla')

@section('content')
<style>
     section{
        background: #94e1a3; 
        
    }
     .card{
        background: #5eca73;
        border: 4px solid #1c4b27;
    }
    .btn{
        background:#38af50;
    }
    .btn:hover{
        background:#29903e;
    }
    a{
        color:#0a2912;
    }

</style>
 <section class="vh-100 ">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card text-white" >
                        <div class="card-body p-5 text-center">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <h1 class="fw-bold mb-2 text-uppercase">Bienvenido</h1><br><br>
                                <div class="form-outline form-white mb-4">
                                    <input type="email" id="typeEmailX" name="email" class="form-control-lg form-control" placeholder="Correo Electrónico">
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <input type="password" id="typePasswordX" name="password" class="form-control-lg form-control" placeholder="Contraseña">
                                </div>
                                <button class="btn btn-lg px-5" type="submit">Iniciar</button>

                            </form>
                            <p class="mb-0">¿No tienes una cuenta? <a href="{{ route('register') }}">Registrate</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
