<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    // all employee card view
    public function cardAllEmployee(Request $request)
    {
        $users = Employee::all(); 
        $userList = User::all();
        return view('form.allemployeecard',compact('users','userList'));
    }
     // all employee list
     public function index()
     {
        $users = Employee::all();
        $userList = User::all();
         return view('form.employeelist',compact('users','userList'));
     }

    

    // public function create()
    // {   
    //     $userList = User::all();
    //     return view('employees.create',compact('userList'));
    // }


    public function store(Request $request, Employee $employee)
    {
        $employee->create($request->all());

        return redirect()->back()->with('success','Employee Created Successfully');

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
        //
    }

    public function destroy(Employee $employee)
    {
        //
    }
}
