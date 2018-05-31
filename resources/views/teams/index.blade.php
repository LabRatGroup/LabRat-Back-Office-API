@extends('adminlte::page')

@section('title', 'Collaboration teams')

@section('content_header')
    <h1>
        <i class="fa fa-users"></i> @lang('Teams')
        <small>@lang('Collaboration teams')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li class="active"><i class="fa fa-users"></i> @lang('Collaboration teams')</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <br/>
                    <div class="box-tools">
                        <a href="{{ route('team.create') }}" class="btn btn-block btn-success btn-sm" title="@lang("Create new project")"><i class="fa fa-users"></i> @lang("Create collaboration team")
                        </a>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    @if($teams->count() > 0)
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th style="width: 25%">@lang('Team name')</th>
                                <th style="width: 15%">@lang('Owner')</th>
                                <th style="width: 15%">@lang('Updated')</th>
                                <th style="width: 10%">&nbsp;</th>
                            </tr>
                            @foreach($teams as $team)
                                <tr>
                                    <td>
                                        <a href="{{ route('team.show', ['id'=>$team->id]) }}">{{ $team->name }}</a>
                                    </td>
                                    <td>{{ array_first($team->owners())->name }}</td>
                                    <td>{{ $team->updated_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('team.update', ['id'=>$team->id]) }}" class="btn  btn-primary btn-xs" title="@lang('Update project')"><i class="fa fa-edit"></i></a>
                                            <button title="@lang('Delete team')" type="button" class="btn  btn-danger btn-xs" onclick="$('#delete-form-{{ $team->id }}').submit();">
                                                <i class="fa fa-trash"></i></button>
                                        </div>
                                        <form id="delete-form-{{ $team->id }}" action="{{ route('team.delete', ['id' => $team->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
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
                                @lang('There are data collaboration teams available.')
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
