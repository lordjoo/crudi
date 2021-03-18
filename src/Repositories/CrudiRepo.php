<?php

namespace Lordjoo\Crudi\Repositories;

use http\Env\Request;

class CrudiRepo {

    /**
     * @param $request
     * @param $data_obj
     * @param $model
     * @param $storage_folder
     * @return mixed
     */
    public function store($request,$data_obj, $model, $storage_folder) {
        $obj = $data_obj;
        if ($request->allFiles()){
            $img = storeImg($storage_folder,$request);
            $obj['image_id'] = $img->id;
        }
        return $model::create($obj);
    }

}
