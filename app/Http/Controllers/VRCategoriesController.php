<?php namespace App\Http\Controllers;


use App\Models\VrCategories;
use App\Models\VrCategoriesTranslations;
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
        $config['tableName'] = trans('app.adminCategories');
        $config['list'] = VrCategories::get()->toArray();
        $config['route'] = route('app.categories.create');
        $config['create'] = 'app.categories.create';
        $config['edit'] = 'app.categories.edit';
        $config['delete'] = 'app.categories.destroy';
        $baseController = new Controller();
        $config['ignore'] = $baseController->ignore();
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
        $config = $this->getFormData();
        $config['titleForm'] = trans('app.adminCategoriesForm');
        $config['route'] = route('app.categories.create');
        $config['back'] = 'app.categories.index';

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
        $record = VrCategories::find($id)->toArray();

        $record['name'] = $record['translation']['name'];
        $record['language_code'] = $record['translation']['language_code'];

        $config = $this->getFormData();
        $config['record'] = $record;

        $config['titleForm'] =$record['name'];
        $config['route'] = route('app.categories.edit', $id);
        $config['back'] = 'app.categories.index';
        return view('admin.create', $config);
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
        $data = request()->all();
        $record = VrCategories::find($id);
        $record->update($data);
        $data['record_id'] = $id;
        VrCategoriesTranslations::updateOrCreate([
           'record_id' => $id,
            'language_code' => $data['language_code']
            ],$data);
        return redirect(route('app.categories.edit', $record->id));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /vrcategories/{id}
     *
     * @param  int $id
     * @return mixed
     */
    public function destroy($id)
    {
        VrCategoriesTranslations::destroy(VrCategoriesTranslations::where('record_id', $id)->pluck('id')->toArray());
         VrCategories::destroy($id);

        return ["success" => true, "id" => $id];

    }


    public function getFormData()
    {
        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "language_code",
            "options" => getActiveLanguages()
        ];

        $config['fields'][] = [
            "type" => "single_line",
            "key" => "name"
        ];

        return $config;
    }



}