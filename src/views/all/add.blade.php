@extends('crudi::layouts.app')
@push('title')
    | {{$form['title']}}
@endpush
@section('page')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-normal">{{ $form['title'] }}</h4>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ $form['action'] }}" method="post" class="row">
                            @csrf
                            @foreach($fields as $f)
                                <div class="col-md-12">
                                    @component('crudi::fields.'.$f['type'],['c'=>$f['col'],'name'=>$f['name'],'field'=>$f]) @endcomponent
                                </div>
                            @endforeach
                            <div class="col-md-12 mt-2">
                                <button class="btn btn-md btn-success w-100 green darken-2">
                                    {{$form['title']}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
