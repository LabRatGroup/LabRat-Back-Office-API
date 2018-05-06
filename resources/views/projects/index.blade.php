@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h2>@lang('Project List')</h2>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('project.create') }}" class="btn btn-success">@lang("Create new project")</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($projects as $project)
                                <li class="list-group-item">
                                    <a href="{{ route('project.show', ['id'=>$project->id]) }}">{{ $project->title }}</a>
                                    <p>{{ str_limit($project->description, 100, ' [...]') }}</p>
                                    <p>
                                        @foreach($project->users as $member)
                                            <a href="#" class="{{ $member->pivot->is_owner ? 'text-info':'text-secondary' }}">{{ $member->name }}</a>&nbsp;
                                        @endforeach
                                    </p>
                                    <a href="{{ route('project.update', ['id'=>$project->id]) }}" class="btn btn-primary">@lang('Edit')</a>
                                    <button type="button" class="btn btn-danger" onclick="$('#delete-form-{{ $project->id }}').submit();">@lang('Delete')</button>
                                    <form id="delete-form-{{ $project->id }}" action="{{ route('project.delete', ['id' => $project->id]) }}" method="POST">
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
