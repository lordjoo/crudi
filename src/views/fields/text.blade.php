<div class="md-form md-outline">
    <input @if(isset($field['required']) && $field['required']) required @endif @if(isset($val)) value="{{ $val->$c }}" @endif class="form-control" type="text" name="{{$c}}" id="{{$c}}">
    <label for="{{$c}}">{{$name}}</label>
</div>
