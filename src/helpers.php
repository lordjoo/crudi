<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Lordjoo\Crudi\Models\Image;

function storeImg ($model, Request $request)
{
    try {
        $image = new Image();
        $file = Storage::disk('local')
            ->putFileAs(strtolower($model) . "/", $request->file('img_id'), time() . "_$model." . $request->file('img_id')->getClientOriginalName());
        $image->path = $file;
        $image->url = Storage::disk('local')->url($file);
        $image->save();
        return $image;
    } catch (\Exception $e) {
        return \response()->json('failed', 500);
    }
}

function deleteImg($img_id){
    $img = Image::find($img_id);
    if (!$img){
        return null;
    }
    Storage::disk('local')->delete($img->path);
    $img->delete();
    return true;
}

function activeMenuItem($name){
    $cu_route = \Illuminate\Support\Facades\Route::getCurrentRoute()->getName();
    return str_contains($cu_route,$name) ? " active ":" list-group-item-action";
}
