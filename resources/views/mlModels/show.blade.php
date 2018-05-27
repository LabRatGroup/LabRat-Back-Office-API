@extends('adminlte::page')

@section('title', 'Projects')

@section('content_header')
    <h1>
        {{ $model->title }}
        <small>@lang('Model details')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li><a href="{{ route('project.index') }}"><i class="glyphicon glyphicon-th"></i> @lang('Projects')</a></li>
        <li>
            <a href="{{ route('project.show', ['id'=>$model->project->id]) }}"><i class="glyphicon glyphicon-folder-open"></i>{{ $model->project->title }}
            </a>
        </li>
        <li class="active">{{ $model->title }}</li>
    </ol>
@stop

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#states" data-toggle="tab">Trained Model States</a></li>
            <li><a href="#predictions" data-toggle="tab">Prediction Jobs</a></li>
            <li><a href="#info" data-toggle="tab">General Information</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="states">
                @include('mlModelStates.partials.list', ['states'=>$model->states])
            </div>
            <div class="tab-pane" id="predictions">
                @include('predictions.partials.list', ['predictions'=>$model->predictions])
            </div>
            <div class="tab-pane" id="info">
                <div class="row">
                    <div class="col-md-12">
                        <p>{{$model->description}}</p>
                        <p class="text-green">Positive class: <strong>{{ $model->positive }}</strong></p>
                        <a href="{{ $currentState ? route('state.update', ['id'=>$currentState->id]) : route('state.create', ['id'=>$model->id]) }}" class="btn btn-success">@lang('Train model')</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
