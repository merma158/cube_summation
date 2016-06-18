@extends('layout')

@section('header')
  <div class="page-header clearfix">
    <h1>
      <i class="glyphicon glyphicon-align-justify"></i> CubeSumationCommands
        <a class="btn btn-success pull-right" href="{{ route('cube_sumation_commands.index') }}">
        <i class="glyphicon glyphicon-list-alt"></i> Commands</a>
    </h1>

  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h3 class="text-center alert alert-info">{{ $acum }}</h3>
    </div>
  </div>

@endsection