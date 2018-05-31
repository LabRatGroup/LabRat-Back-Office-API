@extends('adminlte::page')

@section('title', __('Machine Learning Model Training'))

@section('content_header')
    <h1>
        {{ $model->title }}
        <small>@lang('Train a machine learning model')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li><a href="{{ route('project.index') }}"><i class="glyphicon glyphicon-th"></i> @lang('Projects')</a></li>
        <li>
            <a href="{{ route('project.show', ['id' => $model->project->id]) }}"><i class="glyphicon glyphicon-th"></i>{{ $model->project->title }}
            </a></li>
        <li><a href="{{ route('model.show', ['id' => $model->id]) }}"><i class="fa fa-cogs"></i>{{ $model->title }}</a>
        </li>
        <li class="active"><i class="fa fa-tasks"></i> @lang('Train model')</li>
    </ol>
@stop
@section('content')

    <div class="row">
        <div class="col-md-push-2 col-md-8">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('Train model')</h3>
                </div>
                <form method="POST" enctype="multipart/form-data" action="{{ $state->id? route('state.save', ['id'=>$state->id]) : route('state.store') }}">
                    <input type="hidden" name="_method" value="{{ $state->id ? 'PATCH' : 'POST' }}">
                    @csrf
                    <div class="box-body">
                        <ml-state-form></ml-state-form>
                        <input type="hidden" id="ml_model_id" name="ml_model_id" value="{{ $model->id }}">
                        <input type="hidden" id="positive" name="positive" value="{{ $model->positive }}">
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Train model') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
