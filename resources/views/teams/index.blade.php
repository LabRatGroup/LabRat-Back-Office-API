@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h2>@lang('Team List')</h2>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('team.create') }}" class="btn btn-success">@lang("Create new team")</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($teams as $team)
                                <li class="list-group-item">
                                    <a href="{{ route('team.show', ['id'=>$team->id]) }}">{{ $team->name }}</a>
                                    <p>
                                        @foreach($team->users as $member)
                                            <a href="#" class="{{ $member->pivot->is_owner ? 'text-info':'text-secondary' }}">{{ $member->name }}</a>&nbsp;
                                        @endforeach
                                    </p>
                                    <a href="{{ route('team.update', ['id'=>$team->id]) }}" class="btn btn-primary">@lang('Edit')</a>
                                    <button type="button" class="btn btn-danger" onclick="$('#delete-form-{{ $team->id }}').submit();">@lang('Delete')</button>
                                    <form id="delete-form-{{ $team->id }}" action="{{ route('team.delete', ['id' => $team->id]) }}" method="POST">
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
