<div class="box-header">
    <br/>
    <div class="box-tools">
        <div class="input-group input-group-sm" style="width: 50px;">
            <div class="input-group-btn">
                <a href="{{ $currentState ? route('state.update', ['id'=>$currentState->id]) : route('state.create', ['id'=>$model->id]) }}" class="btn btn-success"><i class="fa fa-tasks"></i> @lang('Train model')
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /.box-header -->
<div class="box-body table-responsive no-padding">
    @if($model->states()->count() > 0)
        <table class="table table-hover">
            <tbody>
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 20%;">Created</th>
                <th style="width: 25%;">Algorithm</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 30%;">Performance</th>
                <th style="width: 20%;">&nbsp;</th>
            </tr>
            @foreach($model->states as $state)
                @php
                    if(is_null($state->code)) {
                        $color = 'warning';
                        $status = __("frontend.status_pending");
                    }
                    if($state->code == '500') {
                        $color =  'danger';
                        $status = __('frontend.status_fail');
                        }
                    if($state->code == '200') {
                        $color = 'primary';
                        $status = __('frontend.status_ok');
                        }
                    if($currentState && $state->id == $currentState->id) {
                       $color =  'success';
                       $status = __('frontend.status_active');
                        }
                @endphp
                <tr>
                    <td>{{ $state->id }}</td>
                    <td>{{ $state->created_at }}</td>
                    <td>{{ isset($state->algorithm) ? $state->algorithm->name : __('Best performance analysis') }}</td>
                    <td><span class="label label-{{$color}}">{{ $status }}</span></td>
                    <td>
                        @if($state->code == '200')
                            {{ __('frontend.accuracy', ['accuracy' =>$state->score->accuracy*100]) }} /
                            {{ __('frontend.kappa', ['kappa' =>$state->score->kappa]) }}
                        @elseif($state->code == '500')
                            @lang("frontend.status_fail")
                        @else
                            @lang("frontend.status_pending")
                        @endif
                    </td>

                    <td>
                        @if($state->code == '200')
                            <div class="btn-group">
                                <a href="{{ route('state.show', ['id'=>$state->id]) }}" class="btn btn-primary btn-xs" title="@lang('Details')">
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                                @if($currentState && $state->id != $currentState->id)
                                    <a href="{{ route('state.current', ['id'=>$state->id]) }}" class="btn btn-warning btn-xs" title="@lang('Set as current')">
                                        <i class="fa fa-check-circle-o"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-xs" onclick="$('#delete-form-{{ $state->id }}').submit();" title="@lang('Delete')">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <form id="delete-form-{{ $state->id }}" action="{{ route('state.delete', ['id' => $state->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                @endif
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="col-md-push-2 col-md-8">
            <div class="alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-info"></i> @lang('Alert!')</h4>
                @lang('There are no available model states to work with predictions.')
            </div>
        </div>
    @endif
</div>


