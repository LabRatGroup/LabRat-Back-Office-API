@extends('adminlte::page')

@section('title', __('Dashboard'))

@section('content_header')
    <h1>
        @lang('Dashboard')
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-home"></i> @lang('Home')</li>
    </ol>
@stop

@section('content')
    <p>You are logged in!</p>
@stop
