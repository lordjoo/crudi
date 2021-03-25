<?php
namespace Lordjoo\Crudi\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class CrudiModel extends Model
{
     protected $fields = [];

     protected $datatables_custom = [];

     protected $dataTable = [['data'=>'id','title'=>"ID"]];

     protected $dataTableOptions = [];

     public function getFields() :array
     {
         if (!count($this->fields))
         {
             $columns = \Schema::getColumnListing($this->getTable());
             $columns = array_diff($columns,['id','created_at','updated_at','deleted_at']);
             return  $columns;
         }
         return $this->fields;
     }

     public function getCustomDatatableCols() :array
     {
         return $this->datatables_custom;
     }

     public function getDatatables() :array
     {
         $arr = $this->dataTable;
         $arr[] =  [
             'data'   => "id",
             'title'  => "Actions",
             "render" => '`'.Static::actionsHTML().'`'
         ];
         return $arr;
     }


     public function dataTableOptions() :array
     {
         $arr = $this->dataTableOptions;
         return $arr;
     }

     public static function actionsHTML()
     {
         $container_start = '<div class="btns d-flex">';
         $edit_btn = '<button data-model="'.str_replace('App\Models','',get_called_class()).'" data-id="${data}" class="crudi-editItem btn btn-info"><span class="mdi mdi-pencil"></span></button>';
         $delete_btn = '<button data-model="'.str_replace('App\Models','',get_called_class()).'" data-id="${data}" class="crudi-deleteItem btn btn-danger"><span class="mdi mdi-trash-can-outline"></span></button>';
         $container_end = "</div>";
         return $container_start.$edit_btn.$delete_btn.$container_end;
     }
 }
