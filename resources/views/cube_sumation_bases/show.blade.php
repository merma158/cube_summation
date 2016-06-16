@extends('layout')
@section('header')
<div class="page-header">
        <h1>CubeSumationBases / Show #{{$cube_sumation_base->id}}</h1>
        <form action="{{ route('cube_sumation_bases.destroy', $cube_sumation_base->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <button type="submit" class="btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></button>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static"></p>
                </div>
                <div class="form-group">
                     <label for="iterations_number">ITERATIONS_NUMBER</label>
                     <p class="form-control-static">{{$cube_sumation_base->iterations_number}}</p>
                </div>
                    <div class="form-group">
                     <label for="iteration_to_be_do">ITERATION_TO_BE_DO</label>
                     <p class="form-control-static">{{$cube_sumation_base->iteration_to_be_do}}</p>
                </div>
                    <div class="form-group">
                     <label for="status">STATUS</label>
                     <p class="form-control-static">{{$cube_sumation_base->status}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('cube_sumation_bases.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>

@endsection