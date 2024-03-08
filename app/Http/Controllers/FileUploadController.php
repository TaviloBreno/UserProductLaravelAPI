<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        // Verifique se um arquivo foi enviado
        if ($request->hasFile('file')) {
            // Obtenha o arquivo enviado
            $file = $request->file('file');

            // Salve o arquivo e obtenha o caminho
            $filePath = $file->store('uploads');

            // Retorna o caminho do arquivo
            return response()->json(['file_path' => $filePath]);
        }

        // Se nenhum arquivo foi enviado, retorne uma resposta de erro
        return response()->json(['error' => 'Nenhum arquivo enviado'], 400);
    }
}
