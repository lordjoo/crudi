# Changelog

## Version 1.0.7
Update TinyMce Config values  

# In version 1.0.6
Now if you append in a Modal like this sample 
```
<?php

namespace App\Models;
use Lordjoo\Crudi\Models\CrudiModel;

class ManagePatient extends CrudiModel 
{
    protected $appends = ['age'];

    public function getAgeAttribute()
    {
        return Carbon::make($this->date_of_birth)->diffInYears()." Years";
    }

}
```
and you need to show the age column in the datatable you can do this by 2 ways 
* ```['data' => 'age', 'title' => "Children Age"]```
* or you can achive this by a custom releation like this 
  ```
  private $dataTable = [
    [
        'data' => "date_of_birth",'name'=>"age", 'title' => "Child Age", "width" => 200    
        'custom'=>true
    ],
  ];
  
  protected $datatables_custom = [
    [
        "col" => "age",
        "relation" => "age",
    ]
  ];
  ```
  By this method you canuse sorting and order on the ```date_of_birth``` column and display the actual age 

## in version 1.0.5 

* a new component has been added called editor, simple this is a tinemce component for the dashboard and ready integerated with <a href='https://github.com/UniSharp/laravel-filemanager'>laravel file manager</a> 
So just install and configure <a href='https://github.com/UniSharp/laravel-filemanager'>laravel file manager</a> and it will be ready 
* fix a mistake : in version before 1.0.5 when uploading any image i was using local disk instead of public 


