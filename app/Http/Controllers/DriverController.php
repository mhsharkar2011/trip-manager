<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $driver = Driver::query();

        if ($with = request('with')) { //load relationships
            $driver->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $driver->filter(Driver::parseRequest(request('query')));

        //set default sorting
        if (! Driver::hasSorting(request('query'))) {
            $driver->filter(Driver::getDefaultSorting());
        }          
        
        $driver = $driver->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );

        dd($driver);

        return $this->respond($driver);
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
            Driver::validation_rules(),
            Driver::validation_messages(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $driver = Driver::create($request->all());

        return $this->respondCreated($driver);
    }

    public function avatarUpdate(Request $request, $id)
    {
        $user = Driver::findOrFail($id);
        $validator = Validator::make(request()->all(), [
            'file' => 'required|image|mimes:jpg,jpeg,png,gif,svg',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'  => 'ERROR',
                'message'  => $validator->errors()->first(),
            ],415);
        }

        if ($request->hasFile('file')) {
            $filePath = public_path('/uploads/profile/images/');
            if ($user->avatar) {
                File::delete($filePath . $user->avatar);
                File::delete($filePath . 'small_' . $user->avatar);
            }
            $image = $request->file('file');
            $n = $image->getClientOriginalName();
            $pathInfo = pathinfo(str_replace(' ', '_', $n), PATHINFO_FILENAME) . '_' . time();

            $fileName = $pathInfo . '.' . $image->getClientOriginalExtension();
            $small_fileName = 'small_' . $pathInfo . '.' . $image->getClientOriginalExtension();

            if (!is_dir($filePath)) {
                mkdir($filePath, 0777, true);
            }
            $image->move($filePath, $fileName);
            Image::make($filePath . $fileName)->fit(150, 150)->save($filePath . $small_fileName);

            $request['avatar'] = $fileName;
            // $request['avatar_directory'] = '/uploads/profile/images/';
        }
        $user->update($request->all());

        return $this->respond($user)->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        return $this->respond($driver);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        $validation = Validator::make(
            $request->all(), 
            Driver::validation_rules_for_update(),
            Driver::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $driver->update($request->all());

        return $this->respond($driver);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();

        return $this->respondDeleted();
    }
}
