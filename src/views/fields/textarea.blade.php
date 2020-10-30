<div class="md-form mb-4 pink-textarea active-pink-textarea md-outline">
    <textarea @if(isset($field['required']) && $field['required']) required @endif id="{{$c}}" name="{{$c}}" class="md-textarea form-control" rows="3">@if(isset($val)) {{ $val->$c }}@endif</textarea>
    <label for="{{$c}}">{{$name}}</label>
</div>
