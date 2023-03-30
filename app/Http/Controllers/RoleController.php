<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::query();

        if ($with = request('with')) { //load relationships
            $roles->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $roles->filter(Role::parseRequest(request('query')));

        //set default sorting
        if (! Role::hasSorting(request('query'))) {
            $roles->filter(Role::getDefaultSorting());
        }          
        
        $roles = $roles->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );

        // return $this->respond($roles);

        return view('admin.roles.index',compact('roles'));
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
            Role::validation_rules(),
            Role::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $role = Role::create($request->all());

        // return $this->respondCreated($role);
        return redirect()->back()->with('status','Role added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return $this->respond($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validation = Validator::make(
            $request->all(), 
            Role::validation_rules_for_update(),
            Role::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $role->update($request->all());

        return $this->respond($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return $this->respondDeleted();
    }
}
