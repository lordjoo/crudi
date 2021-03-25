<div class="form-group">
    <label for="{{$c}}">{{$name}}</label>
    <input @if(isset($field['required']) && $field['required']) required @endif class="form-control" type="password" name="{{$c}}" id="{{$c}}">
</div>
