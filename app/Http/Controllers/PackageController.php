<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $packages = Package::query();

        if ($with = request('with')) { //load relationships
            $packages->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $packages->filter(Package::parseRequest(request('query')));

        //set default sorting
        if (! Package::hasSorting(request('query'))) {
            $packages->filter(Package::getDefaultSorting());
        }          
        
        $packages = $packages->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );

        if( request()->is('api/*')){
            //an api call
            return $this->respond($packages);
        }else{
            //a web call
            return view('trips.packages.index',['packages'=>$packages])->with('id',(request()->input('page', 1) - 1) * self::ITEMS_PER_PAGE);
        }
        
    }

            /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('trips.packages.create');
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
            Package::validation_rules(),
            Package::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $package = Package::create($request->all());

        if( request()->is('api/*')){
            return $this->respondCreated($package);
        }else{
            return back()->with('status','Package created successfully');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        if (request()->is('api/*')){
            return $this->respond($package);
        }else{
            return view('trips.packages.show',['package'=>$package]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $validation = Validator::make(
            $request->all(), 
            Package::validation_rules_for_update(),
            Package::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $package->update($request->all());

        if (request()->is('api/*')){
            return $this->respond($package);
        }else{
            return redirect()->back()->with('status','Package updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->delete();

        if (request()->is('api/*')){
            return $this->respondDeleted();
        }else{
            return redirect()->back()->with('status','Package deleted');
        }
    }
}
