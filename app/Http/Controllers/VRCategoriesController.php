<?php namespace App\Http\Controllers;


use App\Models\VrCategories;
use App\Models\VrCategoriesTranslations;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;

class VrCategoriesController extends Controller
{


    /**
     * Display a listing of the resource.
     * GET /vrcategories
     *
     * @return Response
     *
     */
    public function index()
    {
        $config['list'] = VrCategories::get()->toArray();
        $config['tableName'] = trans('app.adminCategories');
        $config['create'] = 'app.categories.create';
        return view('admin.list', $config);

    }

    /**
     * Show the form for creating a new resource.
     * GET /vrcategories/create
     *
     * @return Response
     */
    public function create()
    {
        $config['titleForm'] = trans('app.adminCategoriesForm');
        $config['create'] = 'app.categories.create';
        $config['back'] = 'app.categories.index';

        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "language_code",
            "options" => getActiveLanguages()
        ];

        $config['fields'][] = [
            "type" => "single_line",
            "key" => "name"
        ];

        return view('admin.create', $config);
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrcategories
     *
     * @return Response
     */
    public function store()
    {
        $data = request()->all();
        $record = VrCategories::create();

        $data['record_id'] = $record->id;
        VrCategoriesTranslations::create($data);

//      Simple create
//        VrCategoriesTranslations::create([
//	     "record_id" => $record->id,
//            "language_code" => $data['languages_code'],
//            "name" => $data['name']
//        ]);
        //return edit to $record->id
        return redirect(route('app.categories.edit', $record->id));
    }

    /**
     * Display the specified resource.
     * GET /vrcategories/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /vrcategories/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /vrcategories/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /vrcategories/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function getFromData()
    {

    }

}