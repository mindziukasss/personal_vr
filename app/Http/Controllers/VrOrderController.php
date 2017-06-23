<?php namespace App\Http\Controllers;

use App\Models\VrOrder;
use App\Models\VrPages;
use App\Models\VrReservations;
use App\Models\VrUsers;
use Carbon\Carbon;
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
        //

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
		//
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
		//
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
		//
	}

    public function getFormData()
    {

        $config['fields'][] = [
            "type" => "drop_down",
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


        return $config;
    }

}