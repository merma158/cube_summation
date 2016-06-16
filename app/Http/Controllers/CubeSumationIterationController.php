<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CubeSumationBase;
use App\CubeSumationIteration;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CubeSumationIterationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$cube_sumation_iterations = CubeSumationIteration::orderBy('id', 'desc')->paginate(10);

		return view('cube_sumation_iterations.index', compact('cube_sumation_iterations'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{	// check if exist CubeSumation => OPEN => OnlyOne
		if (CubeSumationBase::checkExistsOpenCubeSummation()) {
			return view('cube_sumation_iterations.create');
		}
		return redirect()->route('cube_sumation_bases.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$cube_sumation_iteration = new CubeSumationIteration();

		$cube_sumation_iteration->n = $request->input("n");
    $cube_sumation_iteration->m = $request->input("m");

		$cube_sumation_iteration->save();

		return redirect()->route('cube_sumation_iterations.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$cube_sumation_iteration = CubeSumationIteration::findOrFail($id);

		return view('cube_sumation_iterations.show', compact('cube_sumation_iteration'));
	}
	/**
	 * Display a list of the resource by CubeId
	 */
	public function IterationsByCube($cube_id) {
		$cube_sumation_iterations = CubeSumationIteration::IterationsByCube($cube_id)
																										 ->orderBy('id', 'desc')
																										 ->paginate(10);

		return view('cube_sumation_iterations.index_by_cube', compact('cube_sumation_iterations'));	
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$cube_sumation_iteration = CubeSumationIteration::findOrFail($id);

		return view('cube_sumation_iterations.edit', compact('cube_sumation_iteration'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$cube_sumation_iteration = CubeSumationIteration::findOrFail($id);

		$cube_sumation_iteration->n = $request->input("n");
    $cube_sumation_iteration->m = $request->input("m");

		$cube_sumation_iteration->save();

		return redirect()->route('cube_sumation_iterations.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$cube_sumation_iteration = CubeSumationIteration::findOrFail($id);
		$cube_sumation_iteration->delete();

		return redirect()->route('cube_sumation_iterations.index')->with('message', 'Item deleted successfully.');
	}

}
