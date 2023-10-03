<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(5);

        return view("products.index", compact("products"));
    }

    public function create()
    {
        return view("products.create");
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:20',
            'descripcion' => 'nullable|string|max:255',
            'unit_price' => 'required|numeric|min:0.01',
            'stock' => 'nullable|integer|min:1',
        ];

        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El campo nombre no debe tener más de 20 caracteres.',
            'descripcion.max' => 'La descripción no debe tener más de 255 caracteres.',
            'unit_price.required' => 'El campo precio unitario es obligatorio.',
            'unit_price.numeric' => 'El campo precio unitario debe ser un número.',
            'unit_price.min' => 'El campo precio unitario debe ser mayor que 0.01.',
            'stock.integer' => 'El campo stock debe ser un número entero.',
            'stock.min' => 'El campo stock debe ser al menos 1.',
        ];

        // Validar los datos de entrada
        $request->validate($rules, $messages);

        // Guardar los datos
        Product::create($request->all());

        // Redireccionar con un mensaje flash de sesión
        return redirect()->route("products.index")->with("status", "Producto creado satisfactoriamente!");
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view("products.edit", ["product" => $product]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:20',
            'description' => 'nullable|string|max:255',
            'unit_price' => 'required|numeric|min:0.01',
            'stock' => 'nullable|integer|min:0',
        ];

        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El campo nombre no debe tener más de 20 caracteres.',
            'description.max' => 'La descripción no debe tener más de 255 caracteres.',
            'unit_price.required' => 'El campo precio unitario es obligatorio.',
            'unit_price.numeric' => 'El campo precio unitario debe ser un número.',
            'unit_price.min' => 'El campo precio unitario debe ser mayor que 0.01.',
            'stock.integer' => 'El campo stock debe ser un número entero.',
            'stock.min' => 'El campo stock no puede ser negativo.',
        ];

        $validate = $request->validate($rules, $messages);

        if ($validate['stock'] === null) {
            $validate['stock'] = 0;
        }

        $product->update($validate);

        return redirect()->route("products.index")->with("status", "Producto actualizado satisfactoriamente!");
    }



    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route("products.index")->with("status", "Producto eliminado satisfactoriamente!");
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
}
