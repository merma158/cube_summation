@extends('layout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> CubeSumationIterations / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('cube_sumation_iterations.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('n')) has-error @endif">
                       <label for="n-field">N</label>
                    <input type="text" id="n-field" name="n" class="form-control" value="{{ old("n") }}"/>
                       @if($errors->has("n"))
                        <span class="help-block">{{ $errors->first("n") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('m')) has-error @endif">
                       <label for="m-field">M</label>
                    <input type="text" id="m-field" name="m" class="form-control" value="{{ old("m") }}"/>
                       @if($errors->has("m"))
                        <span class="help-block">{{ $errors->first("m") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('cube_sumation_iterations.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    $('.date-picker').datepicker({
    });
  </script>
@endsection
