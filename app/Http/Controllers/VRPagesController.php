<?php namespace App\Http\Controllers;

use App\Models\VrCategories;
use App\Models\VrCategoriesTranslations;
use App\Models\VrPages;
use App\Models\VrPagesTranslations;
use App\Models\VrResources;
use Illuminate\Routing\Controller;

class VrPagesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /vrpages
     *
     * @return Response
     */

    public function index()
    {
        $config['tableName'] = trans('app.adminPages');
        $config['list'] = VrPages::get()->toArray();
        $config['route'] = route('app.pages.create');
        $config['create'] = 'app.pages.create';
        $config['edit'] = 'app.pages.edit';
        $config['delete'] = 'app.pages.destroy';

        return view('admin.list', $config);
    }


    /**
     * Show the form for creating a new resource.
     * GET /vrpages/create
     *
     * @return Response
     */
    public function create()
    {
        $config = $this->getFormData();
        $config['titleForm'] = trans('app.adminPagesForm');
        $config['route'] = route('app.pages.create');
        $config['back'] = 'app.pages.index';
        return view('admin.create', $config);
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrpages
     *
     * @return Response
     */
    public function store()
    {
        $data = request()->all();
        $record = VrPages::create($data);
        $data['record_id'] = $record->id;
        VrPagesTranslations::create($data);
        return redirect(route('app.pages.edit', $record->id));
    }

    /**
     * Display the specified resource.
     * GET /vrpages/{id}
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
     * GET /vrpages/{id}/edit
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
     * PUT /vrpages/{id}
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
     * DELETE /vrpages/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function getFormData()
    {
        $lang = request('language_code');
        if ($lang == null)
            $lang = app()->getLocale();

        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "language_code",
            "options" => getActiveLanguages()
        ];

        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "category_id",
            "options" => VrCategoriesTranslations::where('language_code', $lang)
                ->pluck('name', 'record_id')->toArray()
        ];

        $config['fields'][] = [
            "type" => "single_line",
            "key" => "title"
        ];

        $config['fields'][] = [
            "type" => "single_line",
            "key" => "description_short"
        ];
        $config['fields'][] = [
            "type" => "single_line",
            "key" => "description_long"
        ];

        $config['fields'][] = [
            "type" => "single_line",
            "key" => "slug"

        ];

        $config['fields'][] = [
            "type" => "image",
            "key" => "cover_id",

        ];


        return $config;
    }

}