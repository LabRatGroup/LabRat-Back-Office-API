@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h2>@lang('Machine Learning Model Predictions')</h2>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($predictions as $prediction)
                                <li class="list-group-item">
                                    <a href="{{ route('prediction.show', ['id'=>$prediction->id]) }}">{{ $prediction->title }}</a>
                                    <p>{{ str_limit($prediction->description, 100, ' [...]') }}</p>
                                    <p>{{ $prediction->model->title }}</p>
                                    <a href="{{ route('prediction.update', ['id'=>$prediction->id]) }}" class="btn btn-primary">@lang('Edit')</a>
                                    <a href="{{ route('prediction.run', ['id'=>$prediction->id]) }}" class="btn btn-success">@lang("Run prediction")</a>
                                    <button type="button" class="btn btn-danger" onclick="$('#delete-form-{{ $prediction->id }}').submit();">@lang('Delete')</button>
                                    <form id="delete-form-{{ $prediction->id }}" action="{{ route('prediction.delete', ['id' => $prediction->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
