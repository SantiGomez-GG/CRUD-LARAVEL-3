<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products list</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    
    @extends("layouts.app")

    @section("title", "listado de Productos")

    @section("content")
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <a href="{{ route('products.create') }}"><button type="button" class="col-12 btn btn-success mt-5 btn-lg">Agregar Producto</button></a>


    <div class="container mt-5">
        @if ($products->count())
            <table id="table1" class="table table-striped mx-auto">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Precio Unitario</th>
                        <th>Stock</th>
                        <th>Ultima actualizacion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-primary">
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->unit_price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->updated_at}}</td>
                            <td>
                            
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('products.edit', $product->id) }}"><button class="btn btn-warning">Editar</button></a>

                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                <button class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {!! $products->links() !!}
            </div>
        @else
            <h4>¡No hay productos cargados!</h4>
        @endif
    </div>
    @endsection

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>  </body>
</html>