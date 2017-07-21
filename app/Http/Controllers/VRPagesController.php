<?php

namespace App\Http\Controllers;


use App\Models\VrCategoriesTranslations;
use App\Models\VrConnPagesResources;
use App\Models\VRPages;
use App\Models\VRPagesTranslations;
use App\Models\VRResources;


class VRPagesController extends Controller
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
        $config['list'] = VRPages::get()->toArray();
        $config['route'] = route('app.pages.create');
        $config['create'] = 'app.pages.create';
        $config['edit'] = 'app.pages.edit';
        $config['delete'] = 'app.pages.destroy';
        $config['show'] = 'app.pages.show';
        $baseController = new Controller();
        $config['ignore'] = $baseController->ignore();
        $config['resource'] = 'app.resources.create';
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
        $resources = request()->file('file');
        if ($resources == null) {
            if (isset($data['cover_id'])) {
                $record = VRPages::create($data);
                $data['cover_id'] = $record->id;
                $data['record_id'] = $record->id;
                VRPagesTranslations::create($data);
            } else {
                $record = VRPages::create($data);
                $data['record_id'] = $record->id;
                VRPagesTranslations::create($data);
            }
        } else {
            $uploadController = new VRResourcesController();
            $record = $uploadController->upload($resources);
            $data['cover_id'] = $record->id;
            $record = VRPages::create($data);
            $data['record_id'] = $record->id;
            VRPagesTranslations::create($data);
        }

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
        $data = VRPages::find($id)->toArray();
        $config['title'] = $data['translation']['title'];
        $config['description_short'] = $data['translation']['description_short'];
        $config['description_long'] = $data['translation']['description_long'];
        $config['path'] = $data['image']['path'];
        $config['files'] = $data['resources_conn'];
        $config['edit'] = route('app.pages.edit', $id);
        $config['back'] = route('app.pages.index');
        $config['delete'] = 'app.resources.destroy';

        return view('admin.pageShow', $config);
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
        $record = VrPages::find($id)->toArray();
        $record['slug'] = $record['translation']['slug'];
        $record['title'] = $record['translation']['title'];
        $record['description_short'] = $record['translation']['description_short'];
        $record['description_long'] = $record['translation']['description_long'];
        $record['language_code'] = $record['translation']['language_code'];
        $record['path'] = $record['image']['path'];

        $config = $this->getFormData();

        $config['record'] = $record;

        $config['titleForm'] = $record['title'];
        $config['route'] = route('app.pages.edit', $id);
        $config['back'] = 'app.pages.index';

        return view('admin.create', $config);
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
        $data = request()->all();

        if (request()->file('file')) {
            $resources = request()->file('file');
            $uploadFile = new VRResourcesController();
            $record = $uploadFile->upload($resources);
            $data['cover_id'] = $record->id;
        } elseif (isset($data["delete"])) {
            $data['cover_id'] = null;
        }
        $record = VRPages::find($id);
        $record->update($data);
        $data['record_id'] = $id;
        VrPagesTranslations::updateOrCreate([
            'record_id' => $id,
            'language_code' => $data['language_code']
        ], $data);
        return redirect(route('app.pages.edit', $record->id));

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


        VrPagesTranslations::destroy(VrPagesTranslations::where('record_id', $id)->pluck('id')->toArray());
//        Simple delete
//        $cover_id = DB::table('vr_pages')->where('id',$id)->value('cover_id');
//        VrResources::where('id', $cover_id )->delete();
        if (VRPages::find($id)->cover_id === 0)
            VRResources::find(VRPages::find($id)->cover_id)->delete();
        VrConnPagesResources::where('page_id', $id)->delete();
        VrPages::destroy($id);

        return ["success" => true, "id" => $id];
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
                ->pluck('name', 'record_id')
        ];

        $config['fields'][] = [
            "type" => "single_line",
            "key" => "title"
        ];
        $config['fields'][] = [
            "type" => "textarea",
            "rows" => 2,
            "columns" => 40,
            "key" => "description_short"
        ];
        $config['fields'][] = [
            "type" => "textarea",
            "rows" => 8,
            "columns" => 40,
            "key" => "description_long"
        ];

        $config['fields'][] = [
            "type" => "single_line",
            "key" => "slug"

        ];

        $config['fields'][] = [
            "type" => "file",
            "key" => "cover_id",
            "file" => VRResources::pluck('path', 'id')->toArray()
        ];

        $config['fields'][] = [
            "type" => "check_box",
            "key" => "delete",
            "options" => [[
                "name" => "delete",
                "value" => "true",
                "title" => trans('app.delete title image')

            ]]
        ];
        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "cover_id",
            "options" => VRResources::pluck('path', 'id')->toArray()

        ];



//        $config['fields'][] = [
//            "type" => "file",
//            "key" => "resource_id",
//            "file" => VRResources::pluck('path', 'id')->toArray()
//        ];


        return $config;
    }

}