<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');


            if ($file->isValid()) {

                $fileName = uniqid('file_') . '.' . $file->getClientOriginalExtension();


                $filePath = $file->storeAs('public', $fileName);


                $fileUrl = Storage::url($filePath);


                $product = new Product();
                $product->name = $request->input('name');
                $product->file_path = $filePath;
                $product->save();


                return response()->json(['file_url' => $fileUrl], 200);
            } else {
                return response()->json(['error' => 'Arquivo inválido'], 400);
            }
        } else {
            return response()->json(['error' => 'Nenhum arquivo enviado'], 400);
        }
    }
}