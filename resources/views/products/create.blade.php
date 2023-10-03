@extends('layouts.app')

@section('title', 'Crear un nuevo Producto')

@section('content')
    <div class="container">
        <h1 class="mt-5">Crear un nuevo Producto</h1>

        @if ($errors->any())
            <div class="alert alert-danger mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" novalidate>
            @csrf

            <div class="form-group mt-4">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>

            <div class="form-group mt-4">
                <label for="description">Descripción:</label>
                <textarea class="form-control" name="description" rows="5">{{ old('description') }}</textarea>
            </div>

            <div class="form-group mt-4">
                <label for="unit_price">Precio Unitario:</label>
                <input type="number" class="form-control" name="unit_price" value="{{ old('unit_price') }}">
            </div>

            <div class="form-group mt-4">
                <label for="stock">Stock:</label>
                <input type="number" class="form-control" name="stock" value="{{ old('stock') }}">
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Guardar Producto</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection

