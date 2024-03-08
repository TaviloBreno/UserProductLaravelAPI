<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:2048', // Adicione a validação para a imagem aqui
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user(); // Obtém o usuário autenticado
        $product = $user->products()->create([
            'name' => $request->name,
            'image_path' => $request->file('image')->store('public/products'), // Armazena o arquivo e associa o caminho ao produto
        ]);

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product, 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048', // Modifique para 'nullable' se a imagem for opcional na atualização
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = Product::findOrFail($id);
        $product->name = $request->name;

        // Verifica se há uma nova imagem enviada
        if ($request->hasFile('image')) {
            // Exclui a imagem antiga se existir
            if ($product->image_path) {
                Storage::delete($product->image_path);
            }
            // Atualiza o caminho da imagem com a nova imagem enviada
            $product->image_path = $request->file('image')->store('public/products');
        }

        $product->save();

        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        // Excluir a imagem associada ao produto, se existir
        if ($product->image_path) {
            Storage::delete($product->image_path);
        }
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}