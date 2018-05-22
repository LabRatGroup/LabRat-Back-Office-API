@extends('layouts.app')

@section('content')
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('project.show', ['id'=>$prediction->model->project->id]) }}">{{ $prediction->model->project->title }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('model.show', ['id'=>$prediction->model->id]) }}">{{ $prediction->model->title }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $prediction->title }}</li>
            </ol>
        </nav>


        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">{{ $prediction->title }}</div>

                    <div class="card-body">
                        <p>{{$prediction->description}}</p>
                    </div>
                </div>

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
        </div>
    </div>
@endsection
