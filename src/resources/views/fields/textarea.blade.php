<div class="form-group">
    <label for="{{$c}}">{{$name}}</label>
    <textarea @if(isset($field['required']) && $field['required']) required @endif id="{{$c}}" name="{{$c}}" class="form-control" rows="3">@if(isset($val)) {{ $val->$c }}@endif</textarea>
</div>
