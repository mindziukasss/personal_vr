<?php namespace App\Http\Controllers;


use App\Models\VrConnPagesResources;
use App\Models\VrPages;
use App\Models\VRResources;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller;

class VRResourcesController extends Controller
{

    public function upload(UploadedFile $file)
    {

        $data =
            [
                "size" => $file->getsize(),
                "mime_type" => $file->getMimetype(),
            ];

        $path = '/upload/' . date("Y/m/d/");
        $fileName = Carbon::now()->timestamp . '-' . $file->getClientOriginalName();
        $file->move(public_path($path), $fileName);
        $data["path"] = $path . $fileName;
        return VRResources::create($data);
//
    }

    /**
     * Display a listing of the resource.
     * GET /vrresources
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * GET /vrresources/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrresources
     *
     * @return Response
     */
    public function store(VRPages $VRPages)
    {
        $data = request()->all();

//        $resources = request()->file('file');
        if (isset($data['files'])) {
            if ($data['files'] != null) {
                $resourcesId = [];
                foreach ($data['files'] as $resource) {
                    $record = $this->upload($resource, null);
                    $resourcesId[] = $record->id;
                }
                foreach ($resourcesId as $id) {
                    VrConnPagesResources::create([
                        'page_id' => $VRPages->id,
                        'resource_id' => $id
                    ]);
                }
            }
        }

        return redirect(route('app.pages.index'));
    }

    /**
     * Display the specified resource.
     * GET /vrresources/{id}
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
     * GET /vrresources/{id}/edit
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
     * PUT /vrresources/{id}
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
     * DELETE /vrresources/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (VRResources::destroy($id) and VrConnPagesResources::where('resource_id', $id)->delete())
        {
            return json_encode(["success" => true, "id" => $id]);
        }elseif(VRResources::destroy($id))
        {
            return json_encode(["success" => true, "id" => $id]);
        }
    }

}