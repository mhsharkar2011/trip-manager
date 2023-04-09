<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    // all employee card view
    public function cardAllEmployee(Request $request)
    {
        $employees = Employee::all(); 
        $users = User::all();
        return view('employees.allemployeecard',compact('employees','users'));
    }
     // all employee list
     public function index()
     {
        $employees = Employee::all();
        $users = User::all();
        return view('employees.index',compact('employees','users'));
     }

    public function store(Request $request, Employee $employee)
    {
        // $employee = Employee::firstOrCreate($employee);

        $employee = $employee->firstOrCreate(
            ['user_id'=>$request->user_id],
            $request->all()
        );

        if($employee->wasRecentlyCreated) {
            Toastr::success('Employee created successfully','Success');
        }else {
            Toastr::warning('Employee already exists','Warning');
        }

        return redirect()->back();
    }

    public function show(Employee $employee)
    {
        //
    }


    public function edit(Employee $employee)
    {
        //
    }

    public function update(Request $request, Employee $employee)
    {
        $input = $request->except('avatar');
        if ($employee->avatar && $request->hasFile('avatar')) {
            Storage::delete('public/employees/avatars/' . $employee->avatar);
            $employee->avatar = null;
        }
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = $employee->id . '-' . $employee->name . '-' . date('Ymd-Hsi') . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/employees/avatars', $filename);
            $employee->avatar = $filename;
            $employee->save();
        }
        $employee->update($input);
        return redirect()->route('admin.customers.index')->with('success', 'Customer Updated Successfully');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        // session()->flash('success', 'Employee deleted');
        Toastr::success('Employee deleted successfully','Success');

        return redirect()->back();
    }
}
