@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form method="POST" action="{{ $team->id? route('team.save', ['id'=>$team->id]) : route('team.store') }}">
                    <input type="hidden" name="_method" value="{{ $team->id ? 'PATCH' : 'POST' }}">
                    @csrf

                    <div class="card  mb-2">
                        <div class="card-header">{{ $team->id? __('Edit Team'): __('Create Team') }}</div>
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Team name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $team->name }}" autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <collaborators-manager :items="{{ $team->users }}" model="team" ></collaborators-manager>

                </form>

            </div>
        </div>
    </div>
@endsection
