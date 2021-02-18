<textarea id="{{$c}}" name="{{$c}}">
    @if(isset($val)) {{ $val->$c }}@endif
</textarea>

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.0/tinymce.min.js"></script>
    <script>
        var editor_config = {
            path_absolute: "/admin/",
            selector: '#{{$c}}',
            height: 500,
            contextmenu:"link table configurepermanentpen",
            image_advtab: true,
            relative_urls: false,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            plugins: 'preview fullpage searchreplace autolink visualblocks visualchars image link media table charmap hr pagebreak nonbreaking anchor lists textcolor wordcount tinymcespellchecker imagetools mediaembed quickbars linkchecker contextmenu colorpicker',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link image | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
            image_advtab: true,
            file_picker_callback: function (callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                })
            }
        };
        tinymce.init(editor_config);
    </script>
@endpush
