@extends('adminlte::page')

@section('title', is_null($team->id)? __('Edit collaboration team').': '.$team->mame: __('Create collaboration team'))

@section('content_header')
    <h1>
        <i class="fa fa-users"></i> @lang('Teams')
        <small>{{ is_null($team->id)? __('Edit collaboration team').': '.$team->mame: __('Create collaboration team') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li class="active"><i class="fa fa-users"></i> @lang('Collaboration teams')</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-push-2 col-md-8">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ is_null($team->id) ? __('Create collaboration team') : __('Edit collaboration team') }}</h3>
                </div>

                <form method="POST" action="{{ $team->id? route('team.save', ['id'=>$team->id]) : route('team.store') }}">
                    <input type="hidden" name="_method" value="{{ $team->id ? 'PATCH' : 'POST' }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="email">{{ __('Team name') }}</label>

                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $team->name }}" autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <collaborators-manager :items="{{ $team->users }}" model="team"></collaborators-manager>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-success"> {{ __('Save') }}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
