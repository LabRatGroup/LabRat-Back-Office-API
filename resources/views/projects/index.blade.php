@extends('adminlte::page')

@section('title', 'Projects')

@section('content_header')
    <h1>
        <i class="glyphicon glyphicon-th"></i> @lang('Projects')
        <small>@lang('Machine learning projects')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li>
        <li class="active"><i class="fa fa-th"></i> @lang('Projects')</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <br/>
                    <div class="box-tools">
                        <a href="{{ route('project.create') }}" class="btn btn-block btn-success btn-sm" title="@lang("Create new project")"><i class="fa fa-folder-open"></i> @lang("Create new project")
                        </a>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    @if($projects->count() > 0)
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th style="width: 25%">@lang('Project Title')</th>
                                <th style="width: 35%">@lang('Description')</th>
                                <th style="width: 15%">@lang('Owner')</th>
                                <th style="width: 15%">@lang('Updated')</th>
                                <th style="width: 10%">&nbsp;</th>
                            </tr>
                            @foreach($projects as $project)
                                <tr>
                                    <td>
                                        <a href="{{ route('project.show', ['id'=>$project->id]) }}">{{ $project->title }}</a>
                                    </td>
                                    <td>{{ str_limit($project->description, 100, ' [...]') }}</td>
                                    <td>{{ array_first($project->owners())->name }}</td>
                                    <td>{{ $project->updated_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('model.create', ['id'=>$project->id]) }}" class="btn  btn-success btn-xs" title="@lang('Create new model')"><i class="fa fa-cogs"></i></a>
                                            <a href="{{ route('project.update', ['id'=>$project->id]) }}" class="btn  btn-primary btn-xs" title="@lang('Update project')"><i class="fa fa-edit"></i></a>
                                            <button title="@lang('Delete project')" type="button" class="btn  btn-danger btn-xs" onclick="$('#delete-form-{{ $project->id }}').submit();">
                                                <i class="fa fa-trash"></i></button>
                                            <form id="delete-form-{{ $project->id }}" action="{{ route('project.delete', ['id' => $project->id]) }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </div>
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
                                @lang('There are projects available available.')
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
