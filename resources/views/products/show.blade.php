@extends("layouts.app")

@section("content")
    <h1 class="d-flex justify-content-center mb-3">Detalles</h1>


    <div class="card border mx-auto" style="width: 75%;">
        <div class="card-body">
            <h4 class="card-title">ID: {{ $product->id }}</h4>
            <p><strong>Nombre:</strong> {{ $product->name }}</p>
            <p><strong>Descripción:</strong> {{ $product->description }}</p>
            <p><strong>Stock:</strong> {{ $product->stock }}</p>
            <p><strong>Precio:</strong> {{ $product->unit_price }}</p>
            
            
            <div class="d-flex justify-content">
                <a class="btn btn-primary" href="{{ route('products.index') }}" class="btn btn-primary">Volver a la lista de productos</a>
            </div>
        </div>
    </div>
@endsection