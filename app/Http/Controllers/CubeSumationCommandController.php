<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CubeSumationCommand;
use Illuminate\Http\Request;

class CubeSumationCommandController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$cube_sumation_commands = CubeSumationCommand::orderBy('id', 'desc')->paginate(10);

		return view('cube_sumation_commands.index', compact('cube_sumation_commands'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('cube_sumation_commands.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$cube_sumation_command = new CubeSumationCommand();

		$cube_sumation_command->command = $request->input("command");
        $cube_sumation_command->params = $request->input("params");

		$cube_sumation_command->save();

		return redirect()->route('cube_sumation_commands.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$cube_sumation_command = CubeSumationCommand::findOrFail($id);

		return view('cube_sumation_commands.show', compact('cube_sumation_command'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$cube_sumation_command = CubeSumationCommand::findOrFail($id);

		return view('cube_sumation_commands.edit', compact('cube_sumation_command'));
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
		$cube_sumation_command = CubeSumationCommand::findOrFail($id);

		$cube_sumation_command->command = $request->input("command");
        $cube_sumation_command->params = $request->input("params");

		$cube_sumation_command->save();

		return redirect()->route('cube_sumation_commands.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$cube_sumation_command = CubeSumationCommand::findOrFail($id);
		$cube_sumation_command->delete();

		return redirect()->route('cube_sumation_commands.index')->with('message', 'Item deleted successfully.');
	}

}
