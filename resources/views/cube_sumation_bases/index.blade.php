@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> CubeSumationBases
            <a class="btn btn-success pull-right" href="{{ route('cube_sumation_bases.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($cube_sumation_bases->count())
                <table class="table table-condensed table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>ITERATIONS NUMBER</th>
                        <th>ITERATION TO BE DO</th>
                        <th>STATUS</th>
                        <th class="text-right">OPTIONS</th>
                      </tr>
                    </thead>

                    <tbody>
                        @foreach($cube_sumation_bases as $cube_sumation_base)
                            <tr>
                              <td>{{$cube_sumation_base->id}}</td>
                              <td>{{$cube_sumation_base->iterations_number}}</td>
                              <td>{{$cube_sumation_base->iteration_to_be_do}}</td>
                              <td>{{$cube_sumation_base->status}}</td>
                              <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('cube_sumation_bases.show', $cube_sumation_base->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <a class="btn btn-xs btn-warning" href="{{ action('CubeSumationIterationController@create') }}">Iterate</a>
                                    <form action="{{ route('cube_sumation_bases.destroy', $cube_sumation_base->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                              </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $cube_sumation_bases->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection