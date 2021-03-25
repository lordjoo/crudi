<div class="form-group">
    <span>Choose Image</span>
    <input accept='image/*' @if(isset($field['required']) && $field['required']) required @endif id="{{$c}}"
           name="{{$c}}" type="file"
           class="form-control-file"
    >
</div>
