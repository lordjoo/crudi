<?php


namespace Lordjoo\Crudi\Traits;

use Lordjoo\Crudi\Exceptions\CrudiException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Lordjoo\Crudi\CrudiDataTable;
use Lordjoo\Crudi\Repositories\CrudiRepo;

trait CrudiControllerTrait
{
    use CrudiEventsTrait ;

    public function all()
    {
        $createRoute = route($this->route . '.create');
        $title = Str::plural(str_replace('App\Models\\', '', $this->model));
        if (!isset($this->data_table)) {
            $table = new CrudiDataTable($this->model);
        } else {
            $table = new $this->data_table($this->model);
        }
        return $table->render("crudi::all.all", compact('title', 'createRoute'));
    }

    public function create()
    {
        $fields = (new $this->model)->getFields();
        $form = [
            'action' => route($this->route . '.store'),
            'title' => trans('crudi::main.add').' '.str_replace("App\Models\\", '', $this->model),
        ];
        return view('crudi::all.add', compact('fields', 'form'));
    }

    public function edit($id)
    {
        $item = $this->model::findOrFail($id);
        $fields = (new $this->model)->getFields();
        $form = [
            'action' => route($this->route . '.update', $id),
            'title' => trans('crudi::main.edit')." ". $item->name
        ];
        return view('crudi::all.edit', compact('fields', 'form', 'item'));
    }

    public function store(Request $request, CrudiRepo $crudiRepo)
    {
        $obj = $request->all();
        if ($request->allFiles()){
            $storage = $this->storage_folder ? $this->storage_folder : "general";
            $img = storeImg($storage,$request);
            $obj['image_id'] = $img->id;
        }
        try {
            $this->model::create($obj);
            return redirect()->route($this->route . '.all')->with(['status' => true]);
        } catch (\Exception $exception) {
            return redirect()->route($this->route . '.create')->withErrors([$exception->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {

        $item = $this->model::findOrFail($id);
        $obj = $request->all();
        if ($request->allFiles()) {
            deleteImg($item->image_id);
            $storage = $this->storage_folder ? $this->storage_folder : "general";
            $img = storeImg($storage, $request);
            $obj['image_id'] = $img->id;
        }
        try {
            $obj = array_filter($obj, fn($value) => !is_null($value) && $value !== '');
            $item->update($obj);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
        return redirect()->route($this->route . '.all')->with(['status' => true]);
    }

    public function delete($id)
    {
        $item = $this->model::findOrFail($id);
        $item->delete();
        return response()->json(['status' => true]);
    }


}
