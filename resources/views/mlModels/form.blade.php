@extends('adminlte::page')

@section('title', is_null($model->id)? __('Create trained model') : __('Edit trained model: '.$model->title) )

@section('content_header')
    <h1>
        <i class="fa fa-cogs"></i> @lang('Trained Models')
        <small>{{ is_null($project->id)? __('Edit trained model').': '.$model->title: __('Create trained model') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li><a href="{{ route('project.index') }}"><i class="glyphicon glyphicon-th"></i> @lang('Projects')</a></li>
        <li>
            <a href="{{ route('project.show', ['id'=>$project->id]) }}"><i class="glyphicon glyphicon-folder-open"></i>{{ $project->title }}
            </a>
        </li>
        <li class="active">
            <i class="fa fa-cogs"></i> {{ is_null($model->id)? __('Create trained model') : __('Edit trained model') }}
        </li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-push-2 col-md-8">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ is_null($model->id) ? __('Create model') : __('Edit model') }}</h3>
                </div>

                <form method="POST" action="{{ $model->id? route('model.save', ['id'=>$model->id]) : route('model.store') }}">
                    <input type="hidden" name="_method" value="{{ $model->id ? 'PATCH' : 'POST' }}">
                    <input type="hidden" id="project_id" name="project_id" value="{{ $project->id }}"/>
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="exampleInputEmail1">{{ __('Model title') }}</label>
                            <input id="title" type="text" class="form-control" name="title" value="{{ $model->title }}" autofocus>
                            @if ($errors->has('title'))
                                <span class="help-block">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('positive') ? ' has-error' : '' }}">
                            <label for="positive">{{ __('Model positive class') }}</label>
                            <input id="positive" type="text" class="form-control{{ $errors->has('positive') ? ' is-invalid' : '' }}" name="positive" value="{{ $model->positive }}" autofocus>
                            @if ($errors->has('positive'))
                                <span class="help-block">{{ $errors->first('positive') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Model description') }}</label>
                            <textarea id="description" type="description" class="form-control" name="description">{{ $model->description }}</textarea>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('Save')</button>
                    </div>
                </form>
            </div>


        </div>
    </div>



@endsection
