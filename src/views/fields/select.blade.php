<select @if(isset($field['required']) && $field['required']) required @endif name="{{ $c }}" class="mdb-select md-form">
    <option value="" disabled selected>{{ $name }}</option>
    @foreach($field['options'] as $q)
    <option @if(isset($val) && $val == $q) selected @endif value="{{ $q }}">{{ $q }}</option>
    @endforeach
</select>
