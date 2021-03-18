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

     public function getFields()
     {
         if (!count($this->fields))
         {
             $columns = \Schema::getColumnListing($this->getTable());
             $columns = array_diff($columns,['id','created_at','updated_at','deleted_at']);
             return  $columns;
         }
         return $this->fields;
     }

     public static function getCustomDatatableCols()
     {
         return (new Static())->datatables_custom;
     }

     public static function dataTable()
     {
         $arr = (new Static())->dataTable;
         $arr[] =  [
             'data'   => "id",
             'title'  => "Actions",
             "render" => '`'.Static::actionsHTML().'`'
         ];
         return $arr;
     }


     public static function dataTableOptions()
     {
         $arr = (new Static())->dataTableOptions;
         return $arr;
     }



     private static function actionsHTML()
     {
         $container_start = '<div class="btns d-flex">';
         $edit_btn = '<button data-model="'.str_replace('App\Models','',get_called_class()).'" data-id="${data}" class="crudi-editItem p-1 btn btn-sm btn-floating btn-primary"><span class="fa fa-edit"></span></button>';
         $delete_btn = '<button data-model="'.str_replace('App\Models','',get_called_class()).'" data-id="${data}" class="crudi-deleteItem p-1 btn btn-sm btn-floating btn-danger"><span class="fa fa-trash"></span></button>';
         $container_end = "</div>";
         return $container_start.$edit_btn.$delete_btn.$container_end;
     }
 }
