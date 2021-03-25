<div class="form-group">
    <label for="#{{ $c }}">{{ $name }}</label>
    <select id="{{ $c }}" @if(isset($field['required']) && $field['required']) required @endif name="{{ $c }}" class="form-control">
        <option value="" disabled  @if(!isset($val)) selected @endif>{{ $name }}</option>
        @foreach($field['options'] as $q)
            <option @if(isset($val) && $val == $q) selected @endif value="{{ $q }}">{{ $q }}</option>
        @endforeach
    </select>
</div>
