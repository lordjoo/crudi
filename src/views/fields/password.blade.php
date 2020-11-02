<div class="md-form md-outline">
    <input @if(isset($field['required']) && $field['required']) required @endif class="form-control" type="password" name="{{$c}}" id="{{$c}}">
    <label for="{{$c}}">{{$name}}</label>
</div>
