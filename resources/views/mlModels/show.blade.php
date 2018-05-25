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
                    @if($model->states()->count() > 0)
                        <ul class="list-group">
                            @foreach($model->states as $state)
                                @php
                                    $prefix = "list-group-item-";
                                    if(is_null($state->code)) $color = $prefix.'warning';
                                    if($state->code == '500') $color =  $prefix.'danger';
                                    if($state->code == '200') $color = '';
                                    if($currentState && $state->id == $currentState->id) $color =  $prefix.'success';
                                @endphp
                                <li class="list-group-item {{$color}} ">
                                    <div class="row mb-3">
                                        <strong class="col-md-4">{{ $state->created_at }}</strong>
                                        <span class="col-md-4">{{ isset($state->algorithm) ? $state->algorithm->name : __('Best performance analysis') }}</span>
                                        @if($state->code == '200')
                                            <div class="col-md-3">
                                                <span>
                                                    {{ __('frontend.accuracy', ['accuracy' =>$state->score->accuracy*100]) }}
                                                    <br/>
                                                    {{ __('frontend.kappa', ['kappa' =>$state->score->kappa]) }}
                                                </span>
                                            </div>
                                        @elseif($state->code == '500')
                                            <span>@lang("frontend.status_fail")</span>
                                        @else
                                            <span>@lang("frontend.status_pending")</span>
                                        @endif

                                    </div>
                                    <div class="col-md-12 align-content-lg-end">
                                        @if($state->code == '200')
                                            <a href="{{ route('state.show', ['id'=>$state->id]) }}" class="btn btn-primary btn-sm">@lang('Details')</a>
                                            @if($currentState && $state->id != $currentState->id)
                                                <a href="{{ route('state.current', ['id'=>$state->id]) }}" class="btn btn-warning btn-sm">@lang('Set as current')</a>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="$('#delete-form-{{ $state->id }}').submit();">@lang('Delete')</button>
                                                <form id="delete-form-{{ $state->id }}" action="{{ route('state.delete', ['id' => $state->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
