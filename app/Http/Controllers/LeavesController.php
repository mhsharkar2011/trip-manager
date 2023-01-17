<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Leaf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $leaves = Leaf::query();

        if ($with = request('with')) { //load relationships
            $leaves->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $leaves->filter(Leaf::parseRequest(request('query')));

        //set default sorting
        if (! Leaf::hasSorting(request('query'))) {
            $leaves->filter(Leaf::getDefaultSorting());
        }          
        
        $leaves = $leaves->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );

        return $this->respond($leaves);
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
            Leaf::validation_rules(),
            Leaf::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $leaf = Leaf::create($request->all());

        return $this->respondCreated($leaf);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Leaf $leaf)
    {
        return $this->respond($leaf);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leaf $leaf)
    {
        $validation = Validator::make(
            $request->all(), 
            Leaf::validation_rules_for_update(),
            Leaf::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $leaf->update($request->all());

        return $this->respond($leaf);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leaf $leaf)
    {
        $leaf->delete();

        return $this->respondDeleted();
    }
}
