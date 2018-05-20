@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">{{ $project->title }}</div>

                    <div class="card-body">
                        <p>{{$project->description}}</p>
                        <a href="{{ route('model.create', ['id'=>$project->id]) }}" class="btn btn-success">@lang('Create model')</a>
                    </div>
                </div>

                <div class="list-group">
                    @foreach($project->models as $model)
                        <a href="{{ route('model.show', ['id'=>$model->id]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $model->title }}</h5>
                                <small>{{ trans_choice('frontend.predictions_count', $model->predictions->count(), ['predictions' =>$model->predictions->count()]) }}</small>
                            </div>
                            <p class="mb-1">{{ $model->description }}</p>
                            <small>{{ trans_choice('frontend.states_count', $model->states->count(), ['states' =>$model->states->count()]) }}
                            </small>
                            @if($model->states->count() > 0 && $model->getCurrentstate())
                                <small> / {{ $model->getCurrentstate()->updated_at }}
                                    ({{ $model->getCurrentstate()->code }})
                                </small>
                            @endif
                        </a>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
