@extends('adminlte::page')

@section('title', __('Model state performance details'. ' - '.$state->model->title))

@section('content_header')
    <h1>
        <i class="fa fa-tasks"></i> {{ $state->model->title }}
        <small>@lang('Model state performance details')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li><a href="{{ route('project.index') }}"><i class="glyphicon glyphicon-th"></i> @lang('Projects')</a></li>
        <li>
            <a href="{{ route('project.show', ['id'=>$state->model->project->id]) }}"><i class="glyphicon glyphicon-folder-open"></i>{{ $state->model->project->title }}
            </a>
        </li>
        <li>
            <a href="{{ route('model.show', ['id'=>$state->model->id]) }}"><i class="fa fa-cogs"></i>{{ $state->model->title }}
            </a>
        </li>
        <li class="active"><i class="fa fa-tasks"></i> Performance details</li>
    </ol>
@stop

@section('content')

    <div class="row">
        <div class="col-md-push-2 col-md-8">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $state->algorithm->name }} - {{ $state->updated_at }}</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>{{ __('Model Performance:') }}</strong>
                            <ul>
                                <li>
                                    <span>{{ __('frontend.accuracy', ['accuracy' =>$state->score->accuracy*100]) }}</span>
                                </li>
                                <li><span>{{ __('frontend.kappa', ['kappa' =>$state->score->kappa]) }}</span></li>
                                <li>
                                    <span>{{ __('frontend.sensitivity', ['sensitivity' =>$state->score->sensitivity]) }}</span>
                                </li>
                                <li>
                                    <span>{{ __('frontend.specificity', ['specificity' =>$state->score->specificity]) }}</span>
                                </li>
                                <li>
                                    <span>{{ __('frontend.precision', ['precision' =>$state->score->precision]) }}</span>
                                </li>
                                <li><span>{{ __('frontend.recall', ['recall' =>$state->score->recall]) }}</span>
                                </li>
                            </ul>

                        </div>
                        <div class="col-md-6">
                            <strong>{{ __('Training Parameters') }}</strong>
                            <ul>
                                <li><span>{{ __('frontend.method', ['method'=> $params->method]) }}</span></li>
                                <li>
                                    <span>{{ __('frontend.preprocessing', ['preprocessing'=> $params->preprocessing]) }}</span>
                                </li>
                                <li><span>{{ __('frontend.metric', ['metric'=> $params->metric]) }}</span></li>
                                <li><span>{{ __('frontend.positive', ['positive'=> $params->positive]) }}</span>
                                </li>
                            </ul>

                            <strong>{{ __('Control Method') }}</strong>
                            <ul>
                                <li>
                                    <span>{{ __('frontend.trainControlMethod', ['trainControlMethod'=> $params->control->trainControlMethod]) }}</span>
                                </li>
                                <li>
                                    <span>{{ __('frontend.trainControlMethodRounds', ['trainControlMethodRounds'=> $params->control->trainControlMethodRounds]) }}</span>
                                </li>
                            </ul>

                            <strong>{{ __('Algorithm parameters:') }}</strong>
                            <ul>
                                @foreach($params->tune[0] as $key=>$value)
                                    <li>
                                    <span>{{ $key }}
                                        (
                                        @foreach($value as $k=>$v)
                                            {{ $k }}: {{ $v }},
                                        @endforeach
                                        )
                                    </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


