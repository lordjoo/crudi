<?php

namespace Lordjoo\Crudi;

use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CrudiDataTable extends DataTable
{

    private $model;
    public function __construct($model)
    {
        $this->model = new $model();
        $this->model_class = $model;
    }

    public function dataTable($query)
    {
        $table =  datatables()->eloquent($query);
        $rawCols = [];
        if (count($this->model->getCustomDatatableCols())){
            foreach ($this->model->getCustomDatatableCols() as $custom) {
                $table->editColumn($custom['col'],function ($i) use ($custom) {
                    if (isset($custom['relation_col']) && !empty($custom['relation_col'])){
                        $data = $i->{$custom['relation']}->{$custom['relation_col']};
                    } else {
                        $data = $i->{$custom['relation']};
                    }
                    if (isset($custom['custom_output'])){
                        return str_replace(':data',$data,$custom['custom_output']);
                    } else {
                        return $data;
                    }
                });
            }
        }
        foreach ($this->model->getCustomDatatableCols() as $custom) {
            if (isset($custom['custom_output'])){
                $rawCols[] = $custom['col'];
            }
        }
        $table->rawColumns($rawCols);
        $table->make();
        return $table;
    }

    public function query()
    {
        return $this->model->newQuery();
    }


    public function html()
    {
        $table_name = strtolower(Str::plural(str_replace('App\Models\\','',$this->model_class)));
        $datatable_options = $this->model->dataTableOptions();
        $builder = $this->builder()
            ->addTableClass('table w-100')
            ->setTableId("$table_name-table")
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip');
        if (isset($datatable_options['page_length']))
            $builder->pageLength((int) $datatable_options['page_length']);
        if (isset($datatable_options['ordering']))
            $builder->orderBy($datatable_options['ordering']['by'],$datatable_options['ordering']['direction']??"ASC");
        else
            $builder->orderBy(1);
        return $builder;
    }


    protected function getColumns()
    {
        $cols = [];
        foreach ($this->model->getDatatables() as $col){
            if (isset($col['custom']) && $col['custom']){
                $c = Column::make($col['name'])->title($col['title'])->name($col['data']);
            } else {
                $c= Column::make($col['data'])->title($col['title']);
            }
            if (isset($col['render'])){
                $c->render($col['render']);
            }
            if (isset($col['width'])){
                $c->width($col['width']);
            }
            $cols[] = $c;
        }
        return $cols;
    }


    protected function filename()
    {
        return str_replace('App\Models\\','',$this->model).'_' . date('YmdHis');
    }
}
