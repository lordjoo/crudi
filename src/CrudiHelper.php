<?php

namespace Lordjoo\Crudi;
use Illuminate\Http\Request;

class CrudiHelper
{
    private $model;
    private $storage_folder;
    public function __construct($model,$storage_folder)
    {
        $this->model = $model;
        $this->storage_folder = $storage_folder;
    }

    public function store(Request $request)
    {
        $obj = $request->all();
        if ($request->allFiles()){
            $img = storeImg($this->storage_folder,$request);
            $obj['img_id'] = $img->id;
        }
        try {
            $item = $this->model::create($obj);
            return $item;
        } catch (\Exception $exception){
            throw new $exception;
            return $exception;
        }
    }
    public function update(Request $request, $id)
    {
        $item = $this->model::findOrFail($id);
        $obj = $request->all();
        if ($request->allFiles()){
            deleteImg($item->img_id);
            $img = storeImg($this->storage_folder,$request);
            $obj['img_id'] = $img->id;
        }

        try {
            $item->update($obj);
            return $item;
        } catch (\Exception $exception){
            throw new $exception;
            return $exception;
        }    }



}



