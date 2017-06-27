<?php
namespace App\Http\Controllers;

use App\Models\VRCategories;
use App\Models\VrCategoriesTranslations;
use App\Models\VRPages;
use App\Models\VRPagesTranslations;
use App\Models\VRResources;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

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
//        dd($data);
        $resources = request()->file('file');
//        dd($resources);
        $uploadController = new VRResourcesController();
        $record = $uploadController->upload($resources);
        $data['cover_id'] = $record->id;
        $record = VRPages::create($data);
        $data['record_id'] = $record->id;
        VRPagesTranslations::create($data);
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
        $record = VrPages::find($id)->toArray();
        $record['slug'] = $record['translation']['slug'];
        $record['title'] = $record['translation']['title'];
        $record['description_short'] = $record['translation']['description_short'];
        $record['description_long'] = $record['translation']['description_long'];
        $record['language_code'] = $record['translation']['language_code'];
        $record['path'] = $record['image']['path'];

        $config = $this->getFormData();

        $config['record'] = $record;

        $config['titleForm'] = $id;
        $config['route'] = route('app.pages.edit', $id);
        $config['back'] = 'app.pages.index';

        return view('admin.create',$config);
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
        $record = VRPages::find($id);
        $record->update($data);
        $data['record_id'] = $id;
        VrPagesTranslations::updateOrCreate([
            'record_id' => $id,
            'language_code' => $data['language_code']
            ],$data);
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
        VRResources::find(VRPages::find($id)->cover_id)->delete();
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
                ->pluck('name','record_id')
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
            "file" => VrResources::pluck('path', 'id')->toArray()
        ];


        return $config;
    }

}