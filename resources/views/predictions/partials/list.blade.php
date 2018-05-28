@if(isset($model))
    <div class="box-header">
        <br/>
        <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 50px;">
                <div class="input-group-btn">
                    <a href="{{ route('prediction.create', ['id'=>$model->id])  }}" class="btn btn-success"><i class="fa fa-bar-chart"></i> @lang('Run prediction job')
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- /.box-header -->
<div class="box-body table-responsive no-padding">
    @if($predictions->count() > 0)
        <table class="table table-hover">
            <tbody>
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 25%;">Date</th>
                <th style="width: 25%;">Algorithm</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 15%;">Sample Count</th>
                <th style="width: 20%;">&nbsp;</th>
            </tr>
            @foreach($predictions as $prediction)
                @php
                    if(is_null($prediction->code)) {
                        $color = 'warning';
                        $status = __("frontend.status_pending");
                    }
                    if($prediction->code == '500') {
                        $color =  'danger';
                        $status = __('frontend.status_fail');
                        }
                    if($prediction->code == '200') {
                        $color = 'success';
                        $status = __('frontend.status_ok');
                        }
                @endphp
                <tr>
                    <td>{{ $prediction->id }}</td>
                    <td>{{ $prediction->updated_at }}</td>
                    <td>{{ $prediction->model->getCurrentState()->algorithm->name }}</td>
                    <td><span class="label label-{{$color}}">{{ $status }}</span></td>
                    <td>{{ $prediction->score->count() }}</td>

                    <td>
                        @if($prediction->code == '200')
                            <div class="btn-group">
                                <a href="{{ route('prediction.show', ['id'=>$prediction->id]) }}" class="btn btn-primary btn-xs" title="@lang('Details')">
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                                <a href="{{ route('prediction.run', ['id'=>$prediction->id]) }}" class="btn btn-warning btn-xs" title="@lang('Run prediction')">
                                    <i class="fa fa-refresh"></i>
                                </a>

                                <button type="button" class="btn btn-danger btn-xs" onclick="$('#delete-form-{{ $prediction->id }}').submit();" title="@lang('Delete')">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <form id="delete-form-{{ $prediction->id }}" action="{{ route('prediction.delete', ['id' => $prediction->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <br/>
        <div class="col-md-push-2 col-md-8">
            <div class="alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-info"></i> @lang('Alert!')</h4>
                @lang('There are no data prediction jobs available.')
            </div>
        </div>
    @endif
</div>

