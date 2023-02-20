<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\HelpContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HelpContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $helpcontent = HelpContent::query();

        if ($with = request('with')) { //load relationships
            $helpcontent->with(explode(',', $with));
        }

        //filter, sorting, selective-columns
        $helpcontent->filter(HelpContent::parseRequest(request('query')));

        //set default sorting
        if (! HelpContent::hasSorting(request('query'))) {
            $helpcontent->filter(HelpContent::getDefaultSorting());
        }

        $helpcontent = $helpcontent->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE),
            request('page', 1)
        );

        return $this->respond($helpcontent);
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
            HelpContent::validation_rules(),
            HelpContent::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }

        $helpcontent = HelpContent::create($request->all());

        return $this->respondCreated($helpcontent);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $key)
    {
        $helpcontent = HelpContent::where('key', $key)->first();
        if ($with = request('with')) { //load relationships
            $helpcontent->with(explode(',', $with));
        }

        return $this->respond($helpcontent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HelpContent $helpcontent)
    {
        $validation = Validator::make(
            $request->all(),
            HelpContent::validation_rules_for_update(),
            HelpContent::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }

        $helpcontent->update($request->all());

        return $this->respond($helpcontent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(HelpContent $helpcontent)
    {
        $helpcontent->delete();

        return $this->respondDeleted();
    }
}
