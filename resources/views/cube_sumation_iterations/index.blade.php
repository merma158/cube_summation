@extends('layout')

@section('header')
    <div class="page-header clearfix">
      <h1>
        <i class="glyphicon glyphicon-align-justify"></i> CubeSumationIterations
        <a class="btn btn-success pull-right" href="{{ route('cube_sumation_iterations.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
      </h1>
    </div>
@endsection

@section('content')
    <div class="row">
      <div class="col-md-12">

        @if($cube_sumation_iterations->count())
            <table class="table table-condensed table-striped">
              <thead>
                  <tr>
                    <th>ID</th>
                    <th>N</th>
                    <th>M</th>
                    <th>Commands to be Do</th>
                    <th>Cube</th>
                    <th class="text-right">OPTIONS</th>
                  </tr>
              </thead>

              <tbody>
                  @foreach($cube_sumation_iterations as $cube_sumation_iteration)
                    <tr>
                      <td>{{$cube_sumation_iteration->id}}</td>
                      <td>{{$cube_sumation_iteration->n}}</td>
                      <td>{{$cube_sumation_iteration->m}}</td>
                      <td>{{$cube_sumation_iteration->commands_to_be_do}}</td>
                      <td>
                        <a class="btn btn-xs btn-primary" href="{{ route('cube_sumation_bases.show', $cube_sumation_iteration->cube_sumation_base_id) }}">
                          <i class="glyphicon glyphicon-th"></i>
                          {{ $cube_sumation_iteration->cube_sumation_base_id }}
                        </a>                        
                      </td>
                      <td class="text-right">
                        <a class="btn btn-xs btn-primary" href="{{ route('cube_sumation_iterations.show', $cube_sumation_iteration->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                        <a class="btn btn-xs btn-success" href="{{ route('commands_by_iteration', $cube_sumation_iteration->id) }}"><i class="glyphicon glyphicon-list-alt"></i> Commands</a>
                        <a class="btn btn-xs btn-warning" href="{{ route('create_by_iteration', $cube_sumation_iteration->id) }}"><i class="glyphicon glyphicon-cog"></i> Command</a>
                        <form action="{{ route('cube_sumation_iterations.destroy', $cube_sumation_iteration->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
            {!! $cube_sumation_iterations->render() !!}
        @else
            <h3 class="text-center alert alert-info">Empty!</h3>
        @endif

      </div>
    </div>

@endsection