@extends('adminlte::page')

@section('title', (is_null($project->id)? __('Create a machine learning project') : __('Edit Project: ').$project->title))

@section('content_header')
    <h1>
        <i class="fa fa-folder-open"></i>  @lang('Project')
        <small>{{ is_null($project->id)? __('Create a machine learning project') : __('Edit a machine learning project') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li><a href="{{ route('project.index') }}"><i class="glyphicon glyphicon-th"></i> @lang('Projects')</a></li>
        <li class="active"><i class="fa fa-folder-open"></i> {{ $project->id? __('Edit Project: '.$project->title): __('Create Project') }}</li>
    </ol>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('Basic project information')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <form method="POST" action="{{ $project->id? route('project.save', ['id'=>$project->id]) : route('project.store') }}">
                    <input type="hidden" name="_method" value="{{ $project->id ? 'PATCH' : 'POST' }}">
                    @csrf

                    <div class="box-body">

                        <div class="col-md-6">

                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="title">{{ __('Project title') }}</label>
                                <input id="title" type="title" class="form-control" name="title" value="{{ $project->title }}" autofocus>
                                @if ($errors->has('title'))
                                    <span class="help-block">{{ $errors->first('title') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="teams">{{ __('Team access') }}</label>

                                <select class="form-control" multiple name="teams[]" id="teams" title="{{ __('Select team access for this project') }}">
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ $team->projects->contains($project->id)  ? 'selected=""' : '' }}>{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('Project description') }}</label>
                                <textarea id="description" name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ $project->description }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <collaborators-manager :items="{{ $project->users }}" model="project"></collaborators-manager>
                        </div>


                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success"> {{ __('Save') }}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection
