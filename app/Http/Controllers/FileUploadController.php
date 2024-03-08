<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        // Verifique se um arquivo foi enviado
        if ($request->hasFile('file')) {
            // Obtenha o arquivo enviado
            $file = $request->file('file');

            // Verifique se o arquivo é válido
            if ($file->isValid()) {
                // Gere um nome único para o arquivo
                $fileName = uniqid('file_') . '.' . $file->getClientOriginalExtension();

                // Armazene o arquivo no diretório storage/app/public
                $filePath = $file->storeAs('public', $fileName);

                // Construa o URL completo do arquivo
                $fileUrl = Storage::url($filePath);

                // Salve o caminho do arquivo no banco de dados
                $product = new Product();
                $product->name = $request->input('name');
                $product->file_path = $filePath;
                $product->save();

                // Retorna o URL do arquivo
                return response()->json(['file_url' => $fileUrl], 200);
            } else {
                // Se o arquivo não for válido, retorne uma resposta de erro
                return response()->json(['error' => 'Arquivo inválido'], 400);
            }
        } else {
            // Se nenhum arquivo foi enviado, retorne uma resposta de erro
            return response()->json(['error' => 'Nenhum arquivo enviado'], 400);
        }
    }
}