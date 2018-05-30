@extends('adminlte::page')

@section('title', 'Trained Models')

@section('content_header')
    <h1>
        <i class="fa fa-cogs"></i> @lang('Trained Models')
        <small>@lang('Machine learning trained models')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li class="active"><i class="fa fa-cogs"></i> @lang('Trained Models')</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">


                <div class="box-body table-responsive no-padding">
                    @include('mlModels.partials.list', ['models'=>$models])
                </div>
            </div>
        </div>
    </div>
@endsection
