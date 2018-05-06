@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h2>@lang('Machine Learning Models List')</h2>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('model.create') }}" class="btn btn-success">@lang("Create new model)</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($models as $model)
                                <li class="list-group-item">
                                    <a href="{{ route('model.show', ['id'=>$model->id]) }}">{{ $model->title }}</a>
                                    <p>{{ str_limit($model->description, 100, ' [...]') }}</p>
                                    <p>{{ $model->project->title }}</p>
                                    <a href="{{ route('model.update', ['id'=>$model->id]) }}" class="btn btn-primary">@lang('Edit')</a>
                                    <button type="button" class="btn btn-danger" onclick="$('#delete-form-{{ $model->id }}').submit();">@lang('Delete')</button>
                                    <form id="delete-form-{{ $model->id }}" action="{{ route('model.delete', ['id' => $model->id]) }}" method="POST">
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
