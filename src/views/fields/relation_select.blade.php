@php
$model_name = "\App\Models\\".\Illuminate\Support\Str::title($field['relation']);
@endphp
<select @if(isset($field['required']) && $field['required']) required @endif name="{{ $c }}" class="mdb-select md-form">
    <option value="" disabled selected>{{ $name }}</option>
    @foreach($model_name::all() as $q)
    <option @if(isset($val) && $val->$c == $q->id) selected @endif value="{{ $q->id }}">{{ $q->name }}</option>
    @endforeach
</select>
