@extends('adminlte::page')

@section('title', 'Trained Model - '.$model->title)

@section('content_header')
    <h1>
        <i class="fa fa-cogs"></i> {{ $model->title }}
        <small>@lang('Trained model details')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li><a href="{{ route('project.index') }}"><i class="glyphicon glyphicon-th"></i> @lang('Projects')</a></li>
        <li>
            <a href="{{ route('project.show', ['id'=>$model->project->id]) }}"><i class="glyphicon glyphicon-folder-open"></i>{{ $model->project->title }}
            </a>
        </li>
        <li class="active"><i class="fa fa-cogs"></i> {{ $model->title }}</li>
    </ol>
@stop

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#states" data-toggle="tab"><i class="fa fa-tasks"></i> Trained Model States</a>
            </li>
            @if($model->getCurrentState())
                <li><a href="#predictions" data-toggle="tab"><i class="fa fa-bar-chart"></i> Prediction Jobs</a></li>
            @endif
            <li><a href="#info" data-toggle="tab"><i class="fa fa-info-circle"></i> General Information</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="states">
                @include('mlModelStates.partials.list', ['states'=>$model->states])
            </div>
            @if($model->getCurrentState())
                <div class="tab-pane" id="predictions">
                    @include('predictions.partials.list', ['predictions'=>$model->predictions])
                </div>
            @endif
            <div class="tab-pane" id="info">
                <div class="row">
                    <div class="col-md-12">
                        @if($model->description)
                            <p>{{$model->description}}</p>
                        @else
                            <p><i>@lang('No description has been provided for this model.')</i></p>
                        @endif
                        <p class="text-green">Positive class: <strong>{{ $model->positive }}</strong></p>
                        <a href="{{ $currentState ? route('state.update', ['id'=>$currentState->id]) : route('state.create', ['id'=>$model->id]) }}" class="btn btn-success"><i class="fa fa-tasks"></i> @lang('Train model')
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
