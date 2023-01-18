<?php

namespace App\Http\Controllers;

use App\Models\User;
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
                
        $user = $user->paginate(
            $items_per_page = request('items_per_page', self::ITEMS_PER_PAGE), 
            $columns = ['*'], 
            $pageName = 'page',             
            request('page', 1)
        );

        return $this->respond($user);
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

        return $this->respondCreated($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->respond($user);
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

        return $this->respond($user);
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
}
