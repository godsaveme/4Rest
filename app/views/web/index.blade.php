@extends('layouts.master')



@section('sidebar')

@if (Session::has('error_message'))
<span>{{ Session::get('error_message') }}</span>
@endif

@stop


@section('content')
  @parent

@stop
