<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<style>
    h1 {
        color: blue;
    }

    thead {
        background-color: black;
        color: white;
    }

    th, td {
        width: 10px; /* Ajusta el ancho según tus necesidades */
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
</style>

<body>
    
        <h1 class="text-center">Datos</h1>
   
        <table class="table table-sm table-bordered">
        <thead>
            <tr>
                
                <th style="width: 80px;">DNI</th>
                <th style="width: 120px;">Nombre completo</th>
                <th style="width: 150px;">Fecha de Nacimiento</th>
                <th style="width: 80px;">Edad</th>
                <th style="width: 120px;">Teléfono</th>
                <th style="width: 200px;">Dirección</th>
            </tr>
        </thead>
        <tbody>
            @foreach($persona as $items);
            <tr>
                <td>{{ $items->dni }}</td>
                <td>{{ $items->nombre }} {{ $items->paterno }} {{ $items->materno }}</td>
                <td>{{ $items->fecha_nacimiento }}</td>
                <td>{{ $items->edad }}</td>
                <td>{{ $items->telefono }}</td>
                <td>{{ $items->direccion }}</td>
            </tr>
            @endforeach;
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
