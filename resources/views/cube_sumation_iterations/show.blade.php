@extends('layout')
@section('header')
<div class="page-header">
        <h1>CubeSumationIterations / Show #{{$cube_sumation_iteration->id}}</h1>
        <form action="{{ route('cube_sumation_iterations.destroy', $cube_sumation_iteration->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
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
                     <label for="n">N</label>
                     <p class="form-control-static">{{$cube_sumation_iteration->n}}</p>
                </div>
                    <div class="form-group">
                     <label for="m">M</label>
                     <p class="form-control-static">{{$cube_sumation_iteration->m}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('cube_sumation_iterations.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>

@endsection