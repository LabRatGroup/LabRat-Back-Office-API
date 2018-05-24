@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form method="POST" enctype="multipart/form-data" action="{{ $prediction->id? route('prediction.save', ['id'=>$prediction->id]) : route('prediction.store') }}">
                    <input type="hidden" name="_method" value="{{ $prediction->id ? 'PATCH' : 'POST' }}">
                    @csrf

                    <div class="card  mb-2">
                        <div class="card-header">{{ $prediction->id? __('Edit Model'): __('Create Prediction Job') }}</div>
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="title" class="col-sm-4 col-form-label text-md-right">{{ __('Prediction job title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $prediction->title }}" autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Prediction job description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ $prediction->description }}</textarea>
                                </div>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <div class="offset-1 col-md-10 ">
                                    <p>Please select file containing the data you wish to use to use for the prediction job.</p>
                                </div>
                                <div class="custom-file offset-1 col-md-10 mb-3">
                                    <input type="file" class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="file">Choose file</label>
                                </div>
                            </div>

                            <input type="hidden" name="ml_model_id" id="ml_model_id" value="{{  $model->id }}"/>
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
