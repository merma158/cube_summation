@extends('layout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> CubeSumationCommands / Edit #{{$cube_sumation_command->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('cube_sumation_commands.update', $cube_sumation_command->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('command')) has-error @endif">
                       <label for="command-field">Command</label>
                    <input type="text" id="command-field" name="command" class="form-control" value="{{ $cube_sumation_command->command }}"/>
                       @if($errors->has("command"))
                        <span class="help-block">{{ $errors->first("command") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('params')) has-error @endif">
                       <label for="params-field">Params</label>
                    <textarea class="form-control" id="params-field" rows="3" name="params">{{ $cube_sumation_command->params }}</textarea>
                       @if($errors->has("params"))
                        <span class="help-block">{{ $errors->first("params") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('cube_sumation_commands.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
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
