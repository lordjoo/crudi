## Custom Views 
if you want to display the data as you want use Custom Views, in Custom Views Crudi will return a custom views instead of the datatable view with the data in ```$data``` variable to the view you chosen 
**Note** the ```$data``` variable is an instance of Elquent model without the pagination   
in the controller create a private property named ```private $custom_views = [];``` and in this array specify the method and it's custom view as follows 
```php
private $custom_views = [
    'create'=>"custom.create",
    "update"=>"custom2.update",
    .....
];
```

## Before event Methods 
in some times we want to make a custom validation to our request but leave the code that handle CRUD events the same 
we make this possible by useing the before method .
let's say you want to set a fixed category based on the logged user you have two ways 
1. add a hiden input holding the value but this will make it easy to change no validation 
2. 2. make this change on the server side, To do this use the ```beforeStore``` method in the desired controller and make sure to return the request object after the validation and mutating it  

```php 

public function beforeStore(Request $request) {
  $obj = $request->all();
  $obj['category_id'] = ...;
  return $obj;
}
```
we will use the returned object and check if there is any files need to be uploaded and upload it then store 

## After event method 
the same as before method but we will pass the stored object as a param to this method 


