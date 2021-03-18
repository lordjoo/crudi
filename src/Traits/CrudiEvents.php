<?php


namespace Lordjoo\Crudi\Traits;


trait CrudiEvents
{
    public function beforeStore($request){return $request;}

    public function afterStore($item){}

    public function beforeUpdate($request,$item){return $request;}

    public function afterUpdate($item){}

    public function beforeDelete($item)
    {}

    public function afterDelete(){}

}
