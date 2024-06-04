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

    public static function storeImage2($image, $path, $fieldName = "image", $_id){
        try{
            echo $fieldName;
            echo $image;
            if($image === null) throw new \Exception;
            $imageName = $_id . "-" . $fieldName . "." . $image->extension();

            $imagePath = $image->storeAs($path, $imageName, "public");

            return $imageName;
        } catch(\Exception $e){
            echo "Image upload error: " . $e->getMessage();
            $route = "default.png";
            return $route;
        }
    }

    public static function multipleUpload(Request $request, $_id, $year)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $uploadedImages = [];

        if ($request->hasFile('images')) {
            $i = 0;
            foreach ($request->file('images') as $image) {
                $i++;
                ImageController::storeImage2($image, "competition-images", $i, $_id);
            }
        }

        return response()->json(['ok' => true]);
    }

}
