@extends('adminlte::page')

@section('title', 'Projects')

@section('content_header')
    <h1>
        {{ $prediction->title }}
        <small>@lang('Prediction job details')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li><a href="{{ route('project.index') }}"><i class="glyphicon glyphicon-th"></i> @lang('Projects')</a></li>
        <li>
            <a href="{{ route('project.show', ['id'=>$prediction->model->project->id]) }}"><i class="glyphicon glyphicon-folder-open"></i>{{ $prediction->model->project->title }}
            </a>
        </li>
        <li>
            <a href="{{ route('model.show', ['id'=>$prediction->model->id]) }}"><i class="fa fa-cogs"></i>{{ $prediction->model->title }}
            </a>
        </li>
        <li class="active">{{ $prediction->title }}</li>
    </ol>
@stop


@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#results" data-toggle="tab">Prediction Job Results</a></li>
            <li><a href="#info" data-toggle="tab">General Information</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="predictions">
                @if($prediction->score()->count() > 0)
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th scope="col">Sample ID</th>
                            <th scope="col">Predicted score</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($prediction->score as $data)
                            <tr>
                                <th scope="row">{{ $data->sample }}</th>
                                <td>{{ $data->prediction }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="tab-pane" id="info">
                <div class="row">
                    <div class="col-md-12">
                        <p>{{$prediction->description}}</p>
                        <a href="{{ route('prediction.run', ['id'=>$prediction->id]) }}" class="btn btn-success">@lang('Run prediction job')</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
