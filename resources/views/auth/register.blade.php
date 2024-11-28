@extends('layout.plantilla')

@section('content')
<style>
    section {
        background: #94e1a3;
    }

    .card {
        background: #5eca73;
        border: 4px solid #1c4b27;
    }

    .btn {
        background: #38af50;
    }

    .btn:hover {
        background: #29903e;
    }

    a {
        color: #0a2912;
    }

    .login-page {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form {
        background: rgba(0, 0, 0, 0.7);
        padding: 40px;
        border-radius: 10px;
        width: 100%;
        max-width: 400px;
        color: white;
    }

    .form h1 {
        margin-bottom: 30px;
        text-align: center;
    }

    .form input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: none;
        font-size: 1em;
    }

    .form button {
        width: 100%;
        padding: 10px;
        background-color: #5eca73;
        border: none;
        border-radius: 5px;
        font-size: 1.2em;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .form button:hover {
        background-color: #29903e;
    }

    .form p {
        text-align: center;
        color: rgba(255, 255, 255, 0.7);
    }

    .form p a {
        color: #fff;
        text-decoration: underline;
    }
</style>

<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card text-white">
                    <div class="card-body p-5 text-center">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <h1 class="fw-bold mb-2 text-uppercase">Regístrate</h1><br><br>

                            <div class="form-outline form-white mb-4">
                                <input type="text" id="name" name="name" class="form-control-lg form-control" placeholder="Nombre de Usuario" required />
                            </div>
                            <div class="form-outline form-white mb-4">
                                <input type="email" id="email" name="email" class="form-control-lg form-control" placeholder="Correo Electrónico" required />
                            </div>
                            <div class="form-outline form-white mb-4">
                                <input type="password" id="password" name="password" class="form-control-lg form-control" placeholder="Contraseña" required />
                            </div>
                            <div class="form-outline form-white mb-4">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control-lg form-control" placeholder="Confirmar Contraseña" required />
                            </div>
                            <button class="btn btn-lg px-5" type="submit">Crear cuenta</button>
                        </form>
                        <p class="mb-0">¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
