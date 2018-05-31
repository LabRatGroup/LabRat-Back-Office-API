@extends('adminlte::page')

@section('title', 'User Profile')

@section('content_header')
    <h1>
        <i class="fa fa-user"></i> @lang('User Profile')
        <small>@lang('Modify user profile information')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li class="active"><i class="fa fa-user"></i> @lang('User profile')</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-push-2 col-md-8">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ __('Edit User profile')  }}</h3>
                </div>

                <form method="POST" action="{{ route('profile.save')  }}">
                    <input type="hidden" name="_method" value="PATCH">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ __('User name') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="name">{{ __('User email') }}</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="name">{{ __('User password') }}</label>
                            <input id="password" type="text" class="form-control" name="password" autofocus>
                            @if ($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    <input type="hidden" id="id" name="id" value="{{ $user->id }}"/>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-success"> {{ __('Save') }}</button>
                    </div>
                </form>
                </form>
            </div>
        </div>
    </div>
@endsection
