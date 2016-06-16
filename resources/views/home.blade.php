@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>
        <div class="panel-body">
          
          <a href="{{ url('cube_sumation_bases') }}">
            <div class="col-md-4 text-center btn-primary">
              <h3>Cube Summation</h3>
              <p class="primary">
                  {{ \App\CubeSumationBase::getOpenCount() }}
              </p>
            </div>
          </a>
          <a href="">
            <div class="col-md-4 text-center btn-danger">
              <h3>Other Exercise</h3>
              <p>0</p>
            </div>
          </a>
          <a href="">
            <div class="col-md-4 text-center btn-success">
              <h3>Other Exercise</h3>
              <p>0</p>
            </div>
          </a>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
