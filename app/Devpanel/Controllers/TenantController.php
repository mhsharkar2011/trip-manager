<?php

namespace App\Devpanel\Controllers;

use App\Devpanel\Models\Tenant;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tenant = Tenant::query();

        if ($with = request('with')) { //load relationships
            $tenant->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $tenant->filter(Tenant::parseRequest(request('query')));

        //set default sorting
        if (! Tenant::hasSorting(request('query'))) {
            $tenant->filter(Tenant::getDefaultSorting());
        }          
        
        $tenant = $tenant->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );

        return $this->respond($tenant);
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
            Tenant::validation_rules(),
            Tenant::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $tenant = Tenant::create($request->all());

        return $this->respondCreated($tenant);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {
        if ($with = request('with')) { //load relationships
            $tenant->with(explode(',', $with));
        }   

        return $this->respond($tenant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tenant $tenant)
    {
        $validation = Validator::make(
            $request->all(), 
            Tenant::validation_rules_for_update($tenant->id),
            Tenant::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $tenant->update($request->all());

        return $this->respond($tenant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();

        return $this->respondDeleted();
    }
}
