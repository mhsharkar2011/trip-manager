<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['totalUsers'] = User::all()->count();
        $user = User::query();

        if ($with = request('with')) { //load relationships
            $user->with(explode(',', $with));
        }

        //filter, sorting, selective-columns
        $user->filter(User::parseRequest(request('query'))); 

        //set default sorting
        if (! User::hasSorting(request('query'))) {
            $user->filter(User::getDefaultSorting());
        }          
                
        $data['users'] = $user->paginate(
            $items_per_page = request('items_per_page', self::ITEMS_PER_PAGE), 
            $columns = ['*'], 
            $pageName = 'page',             
            request('page', 1)
        );

        if(request()->is('api*')){
            return $this->respond($user);
        }else{
            return view('users.index',$data)->with('id',(request()->input('page', 1) - 1) * self::ITEMS_PER_PAGE);
        }
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(), 
            User::validation_rules(),
            User::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }       
        
        request()->merge([
            'password' => bcrypt($request->get('password'))
        ]);        
        $user = User::create($request->all());

        if (app()->environment() !== 'production') {
            $user->email_verified_at = now();
            $user->save();
        }
        Toastr::success('Data Added successfully',"Success");
        if(request()->is('api*')) {
            return $this->respondCreated($user);
        }else {
            return redirect()->route('admin.users.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if ($with = request('with')) { //load relationships
            $user->load(explode(',', $with));
        }        

        if(request()->is('api*')){
            return $this->respond($user);
        }else{
            return view('users.show',compact('user'));
        }
    }

    public function edit(User $user){
        // $roles = $user->roles();
        return view('users.edit', compact('user'));    
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validation = Validator::make(
            $request->all(), 
            User::validation_rules_for_update($user->id),
            User::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }  

        $user->update($request->except('password'));

        if(request()->is('api*')){
            return $this->respond($user);
        }else{
            return back()->with('User Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return $this->respondDeleted();
    }

    public function get_roles()
    {
        $roles = collect(User::ROLES)->map(function($role) {
            return [
                'name' => $role
                ,'label' => ucwords($role)
            ];
        });

        return $this->respond($roles);
    }
}
