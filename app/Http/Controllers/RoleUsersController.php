<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roleusers = RoleUser::query();

        if ($with = request('with')) { //load relationships
            $roleusers->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $roleusers->filter(RoleUser::parseRequest(request('query')));

        //set default sorting
        if (! RoleUser::hasSorting(request('query'))) {
            $roleusers->filter(RoleUser::getDefaultSorting());
        }          
        
        $roleusers = $roleusers->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );

        return $this->respond($roleusers);
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
            RoleUser::validation_rules(),
            RoleUser::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $roleuser = RoleUser::create($request->all());

        return $this->respondCreated($roleuser);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(RoleUser $roleuser)
    {
        return $this->respond($roleuser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoleUser $roleuser)
    {
        $validation = Validator::make(
            $request->all(), 
            RoleUser::validation_rules_for_update(),
            RoleUser::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $roleuser->update($request->all());

        return $this->respond($roleuser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleUser $roleuser)
    {
        $roleuser->delete();

        return $this->respondDeleted();
    }
}
