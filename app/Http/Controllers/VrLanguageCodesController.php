<?php namespace App\Http\Controllers;

use App\Models\VrLanguageCodes;

class VrLanguageCodesController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /vrlanguagecodes
	 *
	 * @return Response
	 */
	public function index()
	{
		$config['tableName'] = trans('app.adminLanguagesTable');
	    $config['list'] = VrLanguageCodes::get()->toArray();
	    $config['callToAction']= 'app.languages.edit';
        $baseController = new Controller();
        $config['ignore'] = $baseController->ignore();
		return view('admin.list',$config);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /vrlanguagecodes/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vrlanguagecodes
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /vrlanguagecodes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /vrlanguagecodes/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /vrlanguagecodes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $data = request()->all();
        $record = VrLanguageCodes::find($id);

		$record->update([
		   'is_active' => $data['is_active']
        ]);

        return $record;
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /vrlanguagecodes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}