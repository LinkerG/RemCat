<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public static function storeImage(Request $request, $path, $fieldName = "image", $_id){
        try{
            echo $fieldName;
            $image = $request->file($fieldName);
            echo $image;
            if($image === null) throw new \Exception;
            $imageName = $_id . $fieldName . "." . $image->extension();

            $imagePath = $image->storeAs($path, $imageName, "public");

            return $imageName;
        } catch(\Exception $e){
            echo "Image upload error: " . $e->getMessage();
            $route = "default.png";
            return $route;
        }
    }
    public function upload(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);
                $uploadedImages[] = [
                    'name' => $image->getClientOriginalName(),
                    'url' => asset('uploads/' . $imageName)
                ];
                // Guarda la información de la imagen en la base de datos si es necesario
            }
        }

        return response()->json(['images' => $uploadedImages]);
    }

}
