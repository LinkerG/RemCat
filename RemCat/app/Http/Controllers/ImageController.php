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
            $imageName = $_id . "." . $image->extension();

            $imagePath = $image->storeAs($path, $imageName, "public");

            return $imageName;
        } catch(\Exception $e){
            echo "Image upload error: " . $e->getMessage();
            return "default.png";
        }
    }
}
