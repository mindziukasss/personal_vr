<?php namespace App\Http\Controllers;

use App\Models\VrOrder;
use App\Models\VrPages;
use App\Models\VrPagesTranslations;
use App\Models\VrReservations;
use App\Models\VrUsers;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DateTimeZone;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class VrOrderController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /vrorder
	 *
	 * @return Response
	 */
	public function index()
	{
        $config['tableName'] = trans('app.adminOrders');
        $config['list'] = VrOrder::get()->toArray();
        $config['route'] = route('app.orders.create');
        $config['edit'] = 'app.orders.edit';
        $config['create'] = 'app.orders.create';
        $config['delete'] = 'app.orders.destroy';
        return view('admin.list', $config);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /vrorder/create
	 *
	 * @return Response
	 */
	public function create()
	{

        $config = $this->getFormData();
        $config['titleForm'] = trans('app.adminOrdersForm');
        $config['route'] = route('app.orders.create');
        $config['back'] = 'app.orders.index';
//        dd($config);
        return view('admin.create', $config);

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vrorder
	 *
	 * @return Response
	 */
	public function store()
	{
        $data = request()->all();
        VrOrder::create($data);

        return redirect(route('app.orders.index'));

    }

	/**
	 * Display the specified resource.
	 * GET /vrorder/{id}
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
	 * GET /vrorder/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$record = VrOrder::find($id)->toArray();

        $config = $this->getFormData();
        $config['record'] = $record;
        $config['titleForm'] = $id;
        $config['route'] = route('app.orders.edit', $id);
        $config['back'] = 'app.orders.index';

        return view('admin.create',$config);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /vrorder/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $data = request()->all();
        $record = VrOrder::find($id);
        $record->update($data);

        return redirect(route('app.orders.index'));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /vrorder/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        VrOrder::destroy($id);
        return ["success" => true, "id" => $id];
	}

    /**
     * @return array
     */

    public function reserv() {

        $data = request()->all();
//        dd($data);
        $time_start =  Carbon::parse($data['time'])->startOfDay();
        $time_end = Carbon::parse($data['time'])->endOfDay();
        return VrReservations::where('experience_id',$data['experience_id'])
                                    ->where('time', '>=' , $time_start )
                                        ->where('time', '<=' , $time_end)
                                        ->pluck('time')->toArray();

    }
    private function getVRroomsWithcategory()
    {
        $pagesData = (new VRPages)->getTable();
        $pagesDataTrans = (new VrPagesTranslations)->getTable();

        return (VRPages::where('category_id', 'virtual_room')->join($pagesDataTrans, "$pagesDataTrans.record_id", '=' ,"$pagesData.id")
            ->pluck("$pagesDataTrans.title", "$pagesData.id")->toArray());

    }



    public function getFormData()
    {

        $options = [];
        $now = Carbon::now();
        $end_data = Carbon::createFromDate()->addDay(14);
        for ($option = $now; $option->lte($end_data); $option->addDay()) {
            $options[$option->format('Y-m-d')] = $option->format('Y-m-d');
        }

        $config['fields'][] = [
          "type" => "drop_down",
            "key" => "time",
            "options" => $options
        ];

        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "virtual_room",
            "options" => $this->getVRroomsWithcategory()
        ];


        $config['fields'][] = [
            "type" => "user_down",
            "key" => "user_id",
            "options" => VrUsers::pluck('email', 'id')->toArray()

        ];

        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "status",
            "options" => [
                'pending' => trans('app.pending'),
                'canceled' => trans('app.canceled'),
                'aproved' => trans('app.aproved')
            ]
        ];

        $config['fields'][] = [
            "type" => "reservation",
            "key" => "reservations",
        ];

        return $config;
    }

}