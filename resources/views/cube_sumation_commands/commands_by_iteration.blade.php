@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> CubeSumationCommands
            <a class="btn btn-success pull-right" href="{{ route('cube_sumation_iterations.index') }}"><i class="glyphicon glyphicon-list"></i> Iterations</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($cube_sumation_commands->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>COMMAND</th>
                            <th>PARAMS</th>
                            <th>ITERATION</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($cube_sumation_commands as $cube_sumation_command)
                            <tr>
                                <td>{{$cube_sumation_command->id}}</td>
                                <td>{{$cube_sumation_command->command}}</td>
                                <td>{{ implode(", ", $cube_sumation_command->params) }}</td>
                                <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('cube_sumation_iterations.show', $cube_sumation_command->cube_sumation_iteration_id) }}"><i class="glyphicon glyphicon-retweet"></i> {{$cube_sumation_command->cube_sumation_iteration_id}}</a>
                                </td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('cube_sumation_commands.show', $cube_sumation_command->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <a class="btn btn-xs btn-warning" href="{{ route('cube_sumation_commands.edit', $cube_sumation_command->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="{{ route('cube_sumation_commands.destroy', $cube_sumation_command->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $cube_sumation_commands->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection