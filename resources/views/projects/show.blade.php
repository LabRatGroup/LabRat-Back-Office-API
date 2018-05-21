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
                        @php
                            $currentState = $model->getCurrentState();
                            $stateCount = $model->states->count();
                            $predictionCount = $model->predictions->count();
                        @endphp

                        <li class="list-group-item">
                            <div class="row">

                                <div class="col-md-8 mb-3">
                                    <a href="{{ route('model.show', ['id'=>$model->id]) }}">{{ $model->title }}</a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="$('#delete-form-{{ $project->id }}').submit();">@lang('Delete')</button>
                                    <a href="{{ route('model.update', ['id'=>$model->id]) }}" class="btn btn-primary btn-sm">@lang('Edit')</a>
                                    <a href="{{ $stateCount > 0 ? route('state.update', ['id'=>$model->id]) : route('state.create', ['id'=>$model->id]) }}" class="btn btn-success btn-sm">@lang('Train')</a>
                                    <form id="delete-form-{{ $model->id }}" action="{{ route('model.delete', ['id' => $model->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </div>

                                <div class="col-md-12 left-content-around mb-3">
                                    <p class="mb-1">{{ $model->description }}</p>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <small>{{ trans_choice('frontend.states_count', $stateCount, ['states' =>$stateCount]) }}</small>
                                    @if($model->states->count() > 0 && $currentState)
                                        <small>&nbsp;({{ $currentState->updated_at }})</small>
                                        @if(isset($currentState->code))
                                            <small class="text-{{ $currentState->code =='200' ?'success':'danger'  }}">
                                                &nbsp;/&nbsp;{{ __('frontend.status_code', ['status' => $currentState->code]) }}
                                            </small>
                                        @else
                                            <small class="text-warning">
                                                &nbsp;/&nbsp;{{ __('frontend.status_pending') }}
                                            </small>
                                        @endif
                                    @endif
                                    <small>
                                        &nbsp;/&nbsp;{{ trans_choice('frontend.predictions_count', $predictionCount, ['predictions' =>$predictionCount]) }}</small>
                                </div>

                            </div>
                        </li>

                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
