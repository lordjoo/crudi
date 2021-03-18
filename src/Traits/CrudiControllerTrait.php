<?php


namespace Lordjoo\Crudi\Traits;

use App\Exceptions\CrudiException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Lordjoo\Crudi\CrudiDataTable;
use Lordjoo\Crudi\Repositories\CrudiRepo;

trait CrudiControllerTrait
{
    use CrudiEvents;

    private $storage_folder = "general";

    public function all()
    {
        $createRoute = route($this->route . '.create');
        $title = Str::plural(str_replace('App\Models\\', '', $this->model));
        if (isset($this->custom_views) && $this->custom_views['all']) {
            $data = $this->model::all();
            return view($this->custom_views['all'], compact("data", 'createRoute', 'title'));
        }
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
            'title' => "Add " . str_replace("App\Models\\", '', $this->model),
        ];
        if (isset($this->custom_views) && $this->custom_views['create']) {
            return view($this->custom_views['create']);
        }
        return view('crudi::all.add', compact('fields', 'form'));
    }

    public function edit($id)
    {
        $item = $this->model::findOrFail($id);
        $fields = (new $this->model)->getFields();
        $form = [
            'action' => route($this->route . '.update', $id),
            'title' => "Edit " . $item->name
        ];
        if (isset($this->custom_views) && $this->custom_views['edit']) {
            return view($this->custom_views['edit'], compact('item', 'form'));
        }
        return view('crudi::all.edit', compact('fields', 'form', 'item'));
    }

    public function store(Request $request, CrudiRepo $crudiRepo)
    {
        $obj = $this->beforeStore($request);
        if (gettype($obj) != 'array')
            throw new CrudiException('beforeStore must return array');
        try {
            $item = $crudiRepo->store($request, $obj, $this->model, $this->storage_folder);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
        $this->afterStore($item);
        return redirect()->route($this->route . '.all')->with(['status' => true]);
    }

    public function update(Request $request, $id)
    {

        $item = $this->model::findOrFail($id);
        $obj = $this->beforeUpdate($request, $item);
        if (gettype($obj) != 'array')
            throw new CrudiException('beforeStore must return array');
        if ($request->allFiles()) {
            deleteImg($item->image_id);
            $img = storeImg($this->storage_folder, $request);
            $obj['image_id'] = $img->id;
        }
        try {
            $item->update($obj);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
        $this->afterUpdate($item);
        return redirect()->route($this->route . '.all')->with(['status' => true]);
    }

    public function delete($id)
    {

        $item = $this->model::findOrFail($id);
        $this->beforeDelete($item);
        $item->delete();
        $this->afterDelete();
        return response()->json(['status' => true]);
    }


}
