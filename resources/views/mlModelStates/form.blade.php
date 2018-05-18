@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form method="POST" action="{{ $state->id? route('state.save', ['id'=>$state->id]) : route('state.store') }}">
                    <input type="hidden" name="_method" value="{{ $state->id ? 'PATCH' : 'POST' }}">
                    @csrf

                    <ml-algorithm-form></ml-algorithm-form>
                    <ml-resampling-form></ml-resampling-form>

                </form>
            </div>
        </div>
    </div>
@endsection
