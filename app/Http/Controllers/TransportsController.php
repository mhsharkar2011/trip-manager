<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Transport;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Validator;

class TransportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$format = 'view')
    {
        $users = User::all();
        $vehicles = Vehicle::all();

        $transports = Transport::query();

        if ($with = request('with')) { //load relationships
            $transports->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $transports->filter(Transport::parseRequest(request('query')));

        //set default sorting
        if (! Transport::hasSorting(request('query'))) {
            $transports->filter(Transport::getDefaultSorting());
        }          
        
        $transports = $transports->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );

        if( request()->is('api/*')){
            //an api call
            return $this->respond($transports);
        }else{
            //a web call
            return view('trips.index',['trips'=>$transports,'users'=>$users,'vehicles'=>$vehicles])->with('id',(request()->input('page', 1) - 1) * self::ITEMS_PER_PAGE);
        }
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $users = User::all();
        $vehicles = Vehicle::all();

        return view('trips.create',['users'=>$users,'vehicles'=>$vehicles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(), 
            Transport::validation_rules(),
            Transport::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $input = $request->all();
    
        $transport = Transport::create($input);

        // return $this->respondCreated($transport);

        return back()->with('status','Trip created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Transport $transport)
    {
        return $this->respond($transport);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transport $transport)
    {
        $validation = Validator::make(
            $request->all(), 
            Transport::validation_rules_for_update(),
            Transport::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $transport->update($request->all());

        return $this->respond($transport);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transport $transport)
    {
        $transport->delete();

        return $this->respondDeleted();
    }
}
