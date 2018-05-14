@extends('layouts.app')

@section('content')
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('project.show', ['id'=>$state->model->project->id]) }}">{{ $state->model->project->title }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('model.show', ['id'=>$state->model->id]) }}">{{ $state->model->title }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $state->algorithm->name }}
                    - {{ $state->updated_at }}</li>
            </ol>
        </nav>


        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">{{ $state->algorithm->name }} - {{ $state->updated_at }}</div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
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
                                <ul>
                                    <li><span>{{ $params->method}}</span></li>
                                    <li><span>{{ $params->preprocessing}}</span></li>
                                    <li><span>{{ $params->metric}}</span></li>
                                    <li><span>{{ $params->positive}}</span></li>
                                    <li>
                                        <ul>
                                            <li><span>{{ $params->control->trainControlMethodRounds}}</span></li>
                                            <li><span>{{ $params->control->trainControlMethod}}</span></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            @foreach($params->tune as $key=>$value)
                                                <li><span>{{ $key }}</span></li>
                                                <ul>
                                                    @foreach($value as $k=>$v)
                                                        <li><span>{{ $k }}: {{ $v }}</span></li>
                                                    @endforeach
                                                </ul>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
