@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> CubeSumationBases
            <a class="btn btn-warning pull-right" href="{{ action('CubeSumationIterationController@create') }}"><i class="glyphicon glyphicon-expand"></i> Iterate</a>
            <a class="btn btn-success pull-right" href="{{ route('cube_sumation_bases.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($cube_sumation_bases->count())
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <table class="table table-condensed table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>ITERATIONS NUMBER</th>
                      <th>ITERATION TO BE DO</th>
                      <th>STATUS</th>
                      <th>RUNNABLE</th>
                      <th class="text-right">OPTIONS</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($cube_sumation_bases as $cube_sumation_base)
                      <tr data-id="{{ $cube_sumation_base->id }}">
                        <td>{{$cube_sumation_base->id}}</td>
                        <td>{{$cube_sumation_base->iterations_number}}</td>
                        <td>{{$cube_sumation_base->iteration_to_be_do}}</td>
                        <td>{{$cube_sumation_base->status}}</td>
                        <td>
                          @if($cube_sumation_base->CanBeRun())
                          <button type="button" class="btn btn-xs btn-info run-info">
                            <i class="glyphicon glyphicon-modal-window"></i>
                          </button>
                          @else
                            NO
                          @endif
                        </td>
                        <td class="text-right">
                          <a class="btn btn-xs btn-primary" href="{{ route('cube_sumation_bases.show', $cube_sumation_base->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                          <a class="btn btn-xs btn-success" href="{{ route('iterations_by_cube', $cube_sumation_base->id) }}"><i class="glyphicon glyphicon-list"></i> Iterations</a>
                          
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
    <!-- Modal -->
    <div class="modal fade" id="cube_run" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Result CubeSummation</h4>
          </div>
          <div class="modal-body">
            <div id="resultado_final_merma158"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        
      </div>
    </div>
    
@endsection

@section('scripts')
  <script type="text/javascript">

    $(document).ready(function(){

      $(".run-info").click(function(){

        var token = $('input[name=_token]').val();
        var id    = $(this).parents('tr').data('id');
        var url   = "{{route('exec', ['id' => 'CUBE_ID'])}}";
        var data  = "_method=POST&_token=" + token;
        
        $.post(
          url.replace("CUBE_ID",id),
          data,
          function(response) {
            $("#resultado_final_merma158").html(response['resultset'].replace(/(\r\n|\n|\r)/gm, "<br>"));
            $("#cube_run").modal('show');
          }
        );
        
      });
    });
  </script>
@endsection

