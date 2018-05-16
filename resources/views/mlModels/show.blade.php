@extends('layouts.app')

@section('content')
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('project.show', ['id'=>$model->project->id]) }}">{{ $model->project->title }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $model->title }}</li>
            </ol>
        </nav>


        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">{{ $model->title }}</div>

                    <div class="card-body">
                        <p>{{$model->description}}</p>
                        <a href="{{ $currentState ? route('state.update', ['id'=>$currentState->id]) : route('state.create', ['id'=>$model->id]) }}" class="btn btn-success">@lang('Train model')</a>
                    </div>
                </div>

                <div class="list-group">
                    @foreach($model->states as $state)
                        <a href="{{ route('state.show', ['id'=>$state->id]) }}" class="list-group-item list-group-item-action flex-column align-items-start {{ $state->id == $currentState->id ? 'active' : '' }}">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $model->updated_at }}</h5>
                                <small>{{ __('frontend.accuracy', ['accuracy' =>$state->score->accuracy*100]) }}</small>
                                <small>{{ __('frontend.kappa', ['kappa' =>$state->score->kappa]) }}</small>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
