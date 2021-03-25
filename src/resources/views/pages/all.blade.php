<div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header white d-flex align-items-center justify-content-between">
                        <h3>{{ $title }}</h3>
                        <a href="{{$createRoute}}" class="btn btn-sm btn-primary"><span class="fa fa-plus mr-2"></span>Add {{ \Illuminate\Support\Str::singular($title) }}</a>
                    </div>
                    <div class="card-body">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('js')
    {{$dataTable->scripts()}}
    <script>

    </script>
@endpush
