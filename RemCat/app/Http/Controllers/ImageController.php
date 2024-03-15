<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public static function storeImage(Request $request, $path, $fieldName = "image", $_id, $isCompetition = "false"){
        try{
            echo $fieldName;
            $image = $request->file($fieldName);
            echo $image;
            if($image === null) throw new \Exception;
            $imageName = $_id . "." . $image->extension();

            $imagePath = $image->storeAs($path, $imageName . $fieldName, "public");

            return $imageName;
        } catch(\Exception $e){
            echo "Image upload error: " . $e->getMessage();
            if($isCompetition) $route = "../../default-" . $fieldName . ".png";
            else $route = "default.png";
            return $route;
        }
    }
}
