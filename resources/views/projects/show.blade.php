@extends('adminlte::page')

@section('title', 'Projects')

@section('content_header')
    <h1>
        {{ $project->title }}
        <small>@lang('Project details')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li><a href="{{ route('project.index') }}"><i class="glyphicon glyphicon-th"></i> @lang('Projects')</a></li>
        <li class="active">{{ $project->title }}</li>
    </ol>
@stop

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">General Information</a></li>
            <li><a href="#tab_2" data-toggle="tab">Available models</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="row">
                    <div class="col-md-6">
                        <h4>@lang('Project description')</h4>
                        <p>{{$project->description}}</p>
                    </div>
                    <div class="col-md-3">
                        <h4>@lang('Project Members')</h4>
                        @foreach($project->users as $member)
                            <li>{{ $member->name }}</li>
                        @endforeach
                    </div>
                    <div class="col-md-3">
                        <h4>@lang('Associated Teams')</h4>
                        @foreach($project->teams as $team)
                            <li>{{ $team->name }}</li>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_2">
                @include('mlModels.partials.list', ['models'=>$project->models])
            </div>
        </div>
    </div>

@endsection
