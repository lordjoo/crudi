# Laravel Crudi
A laravel package that implements a ready-made Admin panel with a CRUD System 

## Features 
* Material Design Admin Panel Ready
* Full CRUD System 
* Supports Datatables 

## Requirements 
* laravel >= 8
* php >= 7.3

## Usage 

### Installation
* install it using composer by running   ```composer require lordjoo/crudi```
* then you need to publish the assets files, and the config files needed by running ```php artisan vendor:publish```
* then you need to run ```php artisan migrate``` to create the images table (this tables used to store any king of images related one-to-one to any other modals)

### How it's working ?
This library depends on **two** main things 
1. CrudiControllerTrait  

We made a trait with all the CRUD Logic and made it available to use in any controller 

2. the CrudiModal  <!-- you must fix it -->
 
In order to make the CRUD Operations much smoother we made a Custom abstract class called CrudiModel this class extends the Laravel Model base class 

### Get Started
Will assume that we have a blog and we need to use Crudi to handle the post CRUD Operations .<br>
* First of all we will create the Post Model,Controller and migration
```bash
php artisan make:model Post -mc
```
* After this we will go to the ```PostController.php``` and use the CrudiControllerTrait, The Controller should be look like that 
```php
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Lordjoo\Crudi\Traits\CrudiControllerTrait;

class PostController extends Controller
{
    use CrudiControllerTrait;
}
```
* Then we have to edit the Post Model at ```Post.php`` located in Models directory and make it look like this 
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Lordjoo\Crudi\Models\CrudiModel;

class Post extends CrudiModel
{
    use HasFactory;
}
```

* After this you must open the web.php file in routes folder to add the Routes to it
  Crudi provides a Route macro called crudi that will do all the heavy work of defining all the routes names, prefix and action 

So Open the web.php and add this line 
```php
Route::crudi('posts', 'posts.',\App\Http\Controllers\PostController::class);
```
The first param is the route prefix, Second for the route name prefix, and the last one for the target Controller 
,Crudi will generate the following routes for you 

| PATH | METHOD | ACTION | NAME |
|------|--------|--------|------|
|  {prefix}/       | GET  | Controlller@index  |  .all 
| {prefix}/create  | GET  | Controlller@create | .create |
| {prefix}/create  | POST  | Controlller@store | .store |
| {prefix}/update/{?id}  | GET  | Controlller@edit | .edit |
| {prefix}/update/{?id}  | POST  | Controlller@update | .update |
| {prefix}/delete/{?id}  | GET  | Controlller@delete | .delete |

* Now, We have to define some REQUIRED Properties in the PostController 
  - ```private $model = App\Models\Post::class```  this will hold the associated Model for this Controller
  - ```private $route = "posts"``` this will hold the route name which we had just add as the second param in the Route::crudi macro     

NOW We almost finish, You can go to ```http://localhost:8001/posts/create``` and you will get the add post page , But the page will be empty 
You need to define the field of the post, We will do this by going to the PostModel and add a 
**protected**  property called **fields**  this property will be of 2D Array type with this shape 
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Lordjoo\Crudi\Models\CrudiModel;

class Post extends CrudiModel
{
    use HasFactory;

    /*
     * System use this object to create the form for creating and updating the model
     * Types available :
     * - text
     * - file
     * - textarea
     * - relation_select 
    */

    protected $fields = [
        [
            'type'=>"text", 
            'name'=>"Title",
            'col'=>'name',
        ],
        [
            'type'=>"textarea",
            'name'=>"Body",
            'col'=>'body'
        ],
        [
            'type'=>"image",
            "accept"=>"img",
            'name'=>"Post Thumbnail",
            'col'=>'img_id'
        ],
        [
            'type'=>'relation_select',
            "name"=>"Category",
            'col'=>"category_id",
            "relation" => "category"
        ],  
    ];
}
```

The Only thing need explanation is ```relation_select```  type in the field types, <br>
As you see we define a field called Category refers to the category)id column and this field is a relation_select, This means that you will find a select box having all items in the categories_table (relation) to choose the category_id which will be attached to the post 

Another thing here is the *Post Image* field, Crudi has a built in upload image function so if any of your columns shoud be a image just make the type image and crudi will take care of validating and uploading the iamge Note that that all images is stored in ```images table``` and releated by img_id as showen 

* NOW if you saved and go back to the posts/create ou will find the inputs to supply your datat 

After you click save in the create page you will be redirected back to posts/ page with an empty table with just 1 column which id the item ID ,
But How to show all other values of each post ? 

We simple doing this by defining another **protected** called $4datatable
<br>
**NOTE Crudi USES LARAVEL DATATABLES To Generate the {modae}/page**


## Datatables Control
Crudi uses datatables to list ahd show the data in the dashboard, Crudi uses a **protected**
 property called ```$dataTable``` in the Model Class to determine what to list and how to list it   

In our example we will write the $datatable property to list the post title, thumbnail and the category 

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Lordjoo\Crudi\Models\CrudiModel;

class Post extends CrudiModel
{
    use HasFactory;

    protected $dataTable = [
        [
            'data'=>'id',"title"=>"ID"
        ],
        [
            'data'=>"name",'title'=>"Post Title","width"=>200
        ],
        [
            'data'=>"thumbnail_url",'title'=>"Post Photo","render"=>'`<img src="${data}" />`'
        ],
        [
            'data'=>'id','title'=>"Category",'name'=>'category','custom'=>true,"width"=>200
        ]
    ];
 
    protected $datatables_custom = [
        [
            'col'=>"Category",
            "relation"=>"category",
            "relation_col"=>'name'
        ]
    ];
    protected $with = ['category'];
    public function category(){
        return $this->belongsTo(Category::class);
    }

}
```



















