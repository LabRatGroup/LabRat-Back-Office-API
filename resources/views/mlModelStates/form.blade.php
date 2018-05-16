@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form method="POST" action="{{ $state->id? route('state.save', ['id'=>$state->id]) : route('state.store') }}">
                    <input type="hidden" name="_method" value="{{ $state->id ? 'PATCH' : 'POST' }}">
                    @csrf

                    <div class="card mb-2">
                        <div class="card-header">{{ __('Train Model: :model', ['model'=>$model->title]) }}</div>
                        <div class="card-body">
                            <ml-state-form></ml-state-form>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
