<div class="form-group">
    <label for="{{$c}}">{{$name}}</label>
    <input @if(isset($field['required']) && $field['required']) required @endif @if(isset($val)) value="{{ $val->$c }}" @endif class="form-control" type="time" name="{{$c}}" id="{{$c}}">
</div>
