<?php


namespace Lordjoo\Crudi\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Lordjoo\Crudi\CrudiDataTable;

trait CrudiControllerTrait
{

    public function all()
    {
        $createRoute = route($this->route.'.create');
        $title = Str::plural(str_replace('App\Models\\','',$this->model));
        if (!isset($this->data_table)){
            $table = new CrudiDataTable($this->model);
        } else {
            $table = new $this->data_table($this->model);
        }
        return $table->render("crudi::all.all",compact('title','createRoute'));
    }

    public function create()
    {
        $fields = (new $this->model)->getFields();
        $form = [
            'action'=> route($this->route.'.store'),
            'title'=>"Add ".str_replace("App\Models\\",'',$this->model),
        ];
        return view('crudi::all.add',compact('fields','form'));
    }

    public function store(Request $request)
    {

        $obj = $request->all();
        if ($request->allFiles()){
            $img = storeImg($this->storage_folder,$request);
            $obj['img_id'] = $img->id;
        }
        $this->model::create($obj);
        return redirect()->route($this->route.'.all')->with(['status'=>true]);
    }

    public function edit($id)
    {

        $item = $this->model::findOrFail($id);
        $fields = (new $this->model)->getFields();
        $form = [
            'action'=> route($this->route.'.update',$id),
            'title'=>"Edit ".$item->name
        ];
        return view('crudi::all.edit',compact('fields','form','item'));
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
        $item->update($obj);
        return redirect()->route($this->route.'.all')->with(['status'=>true]);
    }

    public function delete($id)
    {

        $item = $this->model::findOrFail($id);
        $item->delete();
        return response()->json(['status'=>true]);
    }



}
