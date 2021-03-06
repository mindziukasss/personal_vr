<?php namespace App\Http\Controllers;

use App\Models\VrLanguageCodes;
use App\Models\VrMenu;
use App\Models\VrMenuTranslations;
use App\Models\VrPages;
use App\Models\VrPagesTranslations;
use Illuminate\Routing\Controller;

class FrontEndController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /user
	 *
	 * @return Response
	 */
	public function index()
    {
       return view('user.frontend');
	}

	public function pageShow ($lang,$slug)
    {
        $data = VrPagesTranslations::where('slug', $slug)->
                                            where('language_code', $lang)->
                                            with(['page'])->first()->toArray();

        return view('user.pageShow', $data);
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /user/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /user
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /user/{id}
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
	 * GET /user/{id}/edit
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
	 * PUT /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}