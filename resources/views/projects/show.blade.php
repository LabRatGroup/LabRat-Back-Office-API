@extends('adminlte::page')

@section('title', 'Project Details - '.$project->title)

@section('content_header')
    <h1>
        <i class="fa fa-folder-open"></i> {{ $project->title }}
        <small>@lang('Project details')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li><a href="{{ route('project.index') }}"><i class="glyphicon glyphicon-th"></i> @lang('Projects')</a></li>
        <li class="active"><i class="fa fa-folder-open"></i> {{ $project->title }}</li>
    </ol>
@stop

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-info-circle"></i> General Information</a>
            </li>
            <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-cogs"></i> Available models</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="row">
                    <div class="col-md-6">
                        <h4>@lang('Project description')</h4>
                        @if($project->description)
                            <p>{{$project->description}}</p>
                        @else
                            <p><i>@lang('No description has been provided for this project.')</i></p>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <h4>@lang('Project Members')</h4>
                        @foreach($project->users as $member)
                            <li>{{ $member->name }}</li>
                        @endforeach
                    </div>
                    <div class="col-md-3">
                        @if($project->teams->count() > 0)
                            <h4>@lang('Associated Teams')</h4>
                            @foreach($project->teams as $team)
                                <li>{{ $team->name }}</li>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_2">
                @include('mlModels.partials.list', ['models'=>$project->models])
            </div>
        </div>
    </div>

@endsection
