    <div class="file-field">
        <div class="btn btn-primary btn-sm float-left">
            <span>Choose file</span>
            <input @if(isset($field['required']) && $field['required']) required @endif id="{{$c}}" name="{{$c}}" type="file">
        </div>
        <div class="file-path-wrapper md-form">
            <input class="file-path p_{{$c}} validate" type="text" placeholder="Upload your file">
        </div>
    </div>
@push('js')
    <script>
        $("#{{$c}}").on('change',function () {
            $('.p_{{$c}}').val($(this).prop('files')[0].name)
        })
    </script>
@endpush
