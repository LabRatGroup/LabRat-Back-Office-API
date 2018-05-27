<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
        <tbody>
        <tr>
            <th style="width: 25%">Title</th>
            <th style="width: 30%">Description</th>
            <th style="width: 15%">States</th>
            <th style="width: 15%">Predictions</th>
            <th style="width: 15%">&nbsp;</th>
        </tr>
        @foreach($project->models as $model)
            @php
                $currentState = $model->getCurrentState();
                if(!$currentState) $currentState = $model->states()->first();
                $stateCount = $model->states->count();
                $predictionCount = $model->predictions->count();
            @endphp
            <tr>
                <td><a href="{{ route('model.show', ['id'=>$model->id]) }}">{{ $model->title }}</a></td>
                <td>{{ str_limit($model->description, 100, ' [...]') }}</td>
                <td>
                    {{ trans_choice('frontend.states_count', $stateCount, ['states' =>$stateCount]) }}
                    @if($model->states->count() > 0 && $currentState)
                        <br/><small>{{ $currentState->updated_at }}</small>
                        @if(isset($currentState->code))
                            <br/>
                            <small class="text-{{ $currentState->code =='200' ?'success':'danger'  }}">
                                &nbsp;{{ __('frontend.status_code', ['status' => $currentState->code]) }}
                            </small>
                        @else
                            <br/>
                            <small class="text-warning">
                                &nbsp;{{ __('frontend.status_pending') }}
                            </small>
                        @endif
                    @endif
                </td>
                <td>
                    <a href="{{route('prediction.index', ['id'=>$model->id])}}">{{ trans_choice('frontend.predictions_count', $predictionCount, ['predictions' =>$predictionCount]) }}</a>
                </td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('model.update', ['id'=>$model->id]) }}" class="btn  btn-primary btn-xs" title="@lang('Edit')"><i class="fa fa-edit"></i></a>
                        <button title="@lang('Delete model')" type="button" class="btn  btn-danger btn-xs" onclick="$('#delete-form-{{ $model->id }}').submit();">
                            <i class="fa fa-trash"></i>
                        </button>
                        <a href="{{ $stateCount > 0 ? route('state.update', ['id'=>$currentState->id]) : route('state.create', ['id'=>$model->id]) }}" title="@lang('Train model')" class="btn  btn-success btn-xs"><i class="fa fa-cogs"></i></a>

                        @if($model->states->count() > 0 && $currentState)
                            <a href="{{ route('prediction.create', ['id'=>$model->id]) }}" class="btn  btn-warning btn-xs" title="@lang('Predict')"><i class="fa fa-bar-chart"></i></a>
                        @endif


                    </div>
                    <form id="delete-form-{{ $model->id }}" action="{{ route('model.delete', ['id' => $model->id]) }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

