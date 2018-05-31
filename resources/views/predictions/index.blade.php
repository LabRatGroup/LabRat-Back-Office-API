@extends('adminlte::page')

@section('title', 'Prediction Jobs')

@section('content_header')
    <h1>
        <i class="fa fa-bar-chart"></i> @lang('Prediction Jobs')
        <small>@lang('Data prediction job list')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li class="active"><i class="fa fa-bar-chart"></i> @lang('Prediction Jobs')</li>
    </ol>
@stop


@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">


                <div class="box-body table-responsive no-padding">
                    @include('predictions.partials.list', ['predictions'=>$predictions])
                </div>
            </div>
        </div>
    </div>

@endsection
