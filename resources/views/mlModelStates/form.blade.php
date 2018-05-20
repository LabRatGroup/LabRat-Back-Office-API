@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form method="POST"  enctype="multipart/form-data" action="{{ $state->id? route('state.save', ['id'=>$state->id]) : route('state.store') }}">
                    <input type="hidden" name="_method" value="{{ $state->id ? 'PATCH' : 'POST' }}">
                    @csrf

                    <ml-state-form></ml-state-form>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="hidden" id="ml_model_id" name="ml_model_id" value="{{ $model->id }}">
                            <input type="hidden" id="positive" name="positive" value="{{ $model->positive }}">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Train model') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
