<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CubeSumationBase;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CubeSumationBaseController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$cube_sumation_bases = CubeSumationBase::orderBy('id', 'desc')->paginate(10);

		return view('cube_sumation_bases.index', compact('cube_sumation_bases'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('cube_sumation_bases.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$cube_sumation_base = new CubeSumationBase();

		$cube_sumation_base->iterations_number = $request->input("iterations_number");
    $cube_sumation_base->user_id = \Auth::user()->id;

		$cube_sumation_base->save();

		return redirect()->route('cube_sumation_bases.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$cube_sumation_base = CubeSumationBase::findOrFail($id);

		return view('cube_sumation_bases.show', compact('cube_sumation_base'));
	}

	public function exec($id, Request $request) {
		$cube_sumation_base = CubeSumationBase::findOrFail($id);
		
		if($request->ajax()){
      return response()->json([
        'resultset' => $cube_sumation_base->Run()
      ]);
    }

    return $cube_sumation_base->Run();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$cube_sumation_base = CubeSumationBase::findOrFail($id);
		$cube_sumation_base->delete();

		return redirect()->route('cube_sumation_bases.index')->with('message', 'Item deleted successfully.');
	}

}
