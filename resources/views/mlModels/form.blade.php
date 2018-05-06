@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form method="POST" action="{{ $model->id? route('model.save', ['id'=>$model->id]) : route('model.store') }}">
                    <input type="hidden" name="_method" value="{{ $model->id ? 'PATCH' : 'POST' }}">
                    @csrf

                    <div class="card  mb-2">
                        <div class="card-header">{{ $model->id? __('Edit Model'): __('Create Model') }}</div>
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="title" class="col-sm-4 col-form-label text-md-right">{{ __('Model title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="name" value="{{ $model->title }}" autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Model description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ $model->description }}</textarea>
                                </div>
                            </div>

                            <input type="hidden" name="project_id" id="project_id" value="{{ $model->id ? $model->project->id : $project->id }}"/>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
