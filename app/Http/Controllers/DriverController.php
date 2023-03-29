<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Driver;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Database\Seeders\UserSeeder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        $drivers = Driver::query();

        if ($with = request('with')) { //load relationships
            $drivers->with(explode(',', $with));
        }        

        //filter, sorting, selective-columns
        $drivers->filter(Driver::parseRequest(request('query')));

        //set default sorting
        if (! Driver::hasSorting(request('query'))) {
            $drivers->filter(Driver::getDefaultSorting());
        }          
        
        $drivers = $drivers->paginateWrap(
            request('items_per_page', self::ITEMS_PER_PAGE), 
            request('page', 1)
        );

        // dd($driver);

        // return $this->respond($driver);
        return view('drivers.index',['drivers'=>$drivers])->with('id',(request()->input('page', 1) - 1) * self::ITEMS_PER_PAGE);
    }

    public function create(){
        return view('drivers.create');
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
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
        ]);

        $driverObj = new Driver();

        if($request->hasFile('avatar')){
            $image = $request->file('avatar');
            $name = time().'.'.$image->getClientOriginalExtension();
            $path = public_path('/upload/drivers');
            $image->move($path, $name);
            $driverObj->avatar = $name;
        }
        $driverObj->user_id = $request->first_name;
        $driverObj->first_name = $request->first_name;
        $driverObj->last_name = $request->last_name;
        $driverObj->contact_number = $request->contact_number;
        $driverObj->save();
        Toastr::success('Data Added successfully',"Success");
        return redirect()->route('admin.drivers.index')->with('success', 'Driver Added Successfully');
    }

    // public function avatarUpdate(Request $request, $id)
    // {
    //     $user = Driver::findOrFail($id);
    //     $validator = Validator::make(request()->all(), [
    //         'file' => 'required|image|mimes:jpg,jpeg,png,gif,svg',
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status'  => 'ERROR',
    //             'message'  => $validator->errors()->first(),
    //         ],415);
    //     }

    //     if ($request->hasFile('file')) {
    //         $filePath = public_path('/uploads/profile/images/');
    //         if ($user->avatar) {
    //             File::delete($filePath . $user->avatar);
    //             File::delete($filePath . 'small_' . $user->avatar);
    //         }
    //         $image = $request->file('file');
    //         $n = $image->getClientOriginalName();
    //         $pathInfo = pathinfo(str_replace(' ', '_', $n), PATHINFO_FILENAME) . '_' . time();

    //         $fileName = $pathInfo . '.' . $image->getClientOriginalExtension();
    //         $small_fileName = 'small_' . $pathInfo . '.' . $image->getClientOriginalExtension();

    //         if (!is_dir($filePath)) {
    //             mkdir($filePath, 0777, true);
    //         }
    //         $image->move($filePath, $fileName);
    //         Image::make($filePath . $fileName)->fit(150, 150)->save($filePath . $small_fileName);

    //         $request['avatar'] = $fileName;
    //         // $request['avatar_directory'] = '/uploads/profile/images/';
    //     }
    //     $user->update($request->all());

    //     return $this->respond($user)->setStatusCode(200);
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        return view('drivers.show',compact('driver'));
    }

    public function edit(Driver $driver)
    {
        $data['driver'] = $driver;
        return view('drivers.edit',$data)->with('status','Driver profile updated successfully');
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
        $input = $request->except('avatar');
        if ($driver->avatar && $request->hasFile('avatar')) {
            Storage::delete('public/drivers/avatars/' . $driver->avatar);
            $driver->avatar = null;
        }
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = $driver->id . '-' . $driver->name . '-' . date('Ymd') . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/drivers/avatars', $filename);
            $driver->avatar = $filename;
            $driver->save();
        }
        $driver->update($input);
        return redirect()->route('admin.drivers.index')->with('success', 'Driver Updated Successfully');
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

        return redirect()->route('admin.drivers.index')->with('status','Driver deleted successfully');
    }

    public function updateStatus(Request $request, Driver $driver)
    {
            $status = $request->status;
            if($status == 1 || $status == 0){
            $driver->status = $status;
            $driver->save();
                return redirect()->back()->with('success', 'Driver status has been updated.');
            }else{
                return redirect()->with('error','Invalid Status');
        }
    }
}
