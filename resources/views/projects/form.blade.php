@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('Create Project')</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('project.save', ['id'=>$project->id]) }}">
                            <input type="hidden" name="_method" value="PATCH">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Project title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $project->title }}"  autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Project description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" >{{ $project->description }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
