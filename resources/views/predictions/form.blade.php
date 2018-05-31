@extends('adminlte::page')

@section('title', 'Data Prediction - '.is_null($prediction->id)? __('Edit data prediction: '.$prediction->title ): __('Create a data prediction'))

@section('content_header')
    <h1>
        @lang('Data Prediction')
        <small>{{ is_null($prediction->id)? __('Edit data prediction: '.$prediction->title ): __('Create data prediction') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li><a href="{{ route('project.index') }}"><i class="glyphicon glyphicon-th"></i> @lang('Projects')</a></li>
        <li>
            <a href="{{ route('project.show', ['id'=>$model->project->id]) }}"><i class="glyphicon glyphicon-folder-open"></i>{{ $model->project->title }}
            </a>
        </li>
        <li>
            <a href="{{ route('model.show', ['id'=>$model->project->id]) }}"><i class="fa fa-cogs"></i>{{ $model->project->title }}
            </a>
        </li>
        <li class="active"><i class="fa fa-bar-chart"></i> {{ is_null($prediction->id)? __('Create prediction') : __('Edit prediction') }}</li>
    </ol>
@stop

@section('content')
    <div class="col-md-push-2 col-md-8">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $prediction->id? __('Edit Model'): __('Create Prediction Job') }}</h3>
            </div>


            <form method="POST" enctype="multipart/form-data" action="{{ $prediction->id? route('prediction.save', ['id'=>$prediction->id]) : route('prediction.store') }}">
                <input type="hidden" name="_method" value="{{ $prediction->id ? 'PATCH' : 'POST' }}">
                @csrf

                <div class="box-body">

                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title">{{ __('Prediction job title') }}</label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ $prediction->title }}" autofocus>
                        @if ($errors->has('title'))
                            <span class="help-block">{{ $errors->first('title') }}</span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="description">{{ __('Prediction job description') }}</label>
                        <textarea id="description" type="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ $prediction->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="file">Please select file containing the data you wish to use to use for the
                            prediction job.</label>
                        <input type="file" class="custom-file-input" id="file" name="file">
                    </div>

                    <input type="hidden" name="ml_model_id" id="ml_model_id" value="{{  $model->id }}"/>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('Save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
