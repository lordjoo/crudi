<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Lordjoo\Crudi\Models\Image;

if (!function_exists("storeImg")){
    function storeImg ($model, Request $request)
    {
        $request->validate([
            "img_id"=>["mimes:jpeg,bmp,png,jpg"]
        ]);
        try {
            $image = new Image();
            $file = Storage::disk('public')
                ->putFileAs(strtolower($model) . "/", $request->file('img_id'), time() . "_" . $request->file('img_id')->getClientOriginalName());
            $image->path = $file;
            $image->url = Storage::disk('public')->url($file);
            $image->save();
            return $image;
        } catch (\Exception $e) {
            return \response()->json('failed', 500);
        }
    }
}

if (!function_exists("deleteImg")){
    function deleteImg($img_id){
        $img = Image::find($img_id);
        if (!$img){
            return null;
        }
        Storage::disk('public')->delete($img->path);
        $img->delete();
        return true;
    }
}

function activeMenuItem($name){
    $cu_route = \Illuminate\Support\Facades\Route::getCurrentRoute()->getName();
    return str_contains($cu_route,$name) ? " active ":" list-group-item-action";
}
