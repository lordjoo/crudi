<?php


namespace Lordjoo\Crudi\Traits;


trait CrudiEventsTrait
{
    public function beforeStore($request){return $request->all();}

    public function afterStore($item){}

    public function beforeUpdate($request,$item){return $request->all();}

    public function afterUpdate($item){}

    public function beforeDelete($item)
    {}

    public function afterDelete(){}

}
