<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
     // all employee list
     public function index()
     {
         $users = DB::table('users')
                     ->join('employees', 'users.id', '=', 'employees.user_id')
                     ->select('users.*', 'employees.*')
                     ->get();
         $userList = User::all();
         return view('form.index',compact('users','userList'));
     }

     // all employee card view
     public function cardAllEmployee(Request $request)
     {
         $users = DB::table('users')
                     ->join('employees', 'users.id', '=', 'employees.id')
                     ->select('users.*', 'employees.*')
                     ->get(); 
         $userList = DB::table('users')->get();
         return view('form.allemployeecard',compact('users','userList'));
     }
    

    // public function create()
    // {   
    //     $userList = User::all();
    //     return view('employees.create',compact('userList'));
    // }


    public function store(Request $request, Employee $employee)
    {
        $employee->create($request->all());

        return redirect()->route('admin.employees.index')->with('success','Employee Created Successfully');

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


    // employee search
    public function employeeSearch(Request $request)
    {
        $users = DB::table('users')
                    ->join('employees', 'users.id', '=', 'employees.user_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender')
                    ->get();
        $userList = DB::table('users')->get();

        // search by id
        if($request->user_id)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.id', '=', 'employees.user_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender')
                        ->where('user_id','LIKE','%'.$request->user_id.'%')
                        ->get();
        }
        // search by full_name
        if($request->full_name)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.id', '=', 'employees.user_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender')
                        ->where('users.full_name','LIKE','%'.$request->full_name.'%')
                        ->get();
        }
        // search by full_name
        if($request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.id', '=', 'employees.user_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }

        // search by full_name and id
        if($request->user_id && $request->full_name)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.id', '=', 'employees.user_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender')
                        ->where('user_id','LIKE','%'.$request->user_id.'%')
                        ->where('users.full_name','LIKE','%'.$request->full_name.'%')
                        ->get();
        }
        // search by position and id
        if($request->user_id && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.id', '=', 'employees.user_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender')
                        ->where('user_id','LIKE','%'.$request->user_id.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }
        // search by full_name and position
        if($request->full_name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.id', '=', 'employees.user_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender')
                        ->where('users.full_name','LIKE','%'.$request->full_name.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }
            // search by full_name and position and id
            if($request->user_id && $request->full_name && $request->position)
            {
                $users = DB::table('users')
                            ->join('employees', 'users.id', '=', 'employees.user_id')
                            ->select('users.*', 'employees.birth_date', 'employees.gender')
                            ->where('user_id','LIKE','%'.$request->user_id.'%')
                            ->where('users.full_name','LIKE','%'.$request->full_name.'%')
                            ->where('users.position','LIKE','%'.$request->position.'%')
                            ->get();
            }
        return view('form.allemployeecard',compact('users','userList'));
    }
    public function employeeListSearch(Request $request)
    {
        $users = DB::table('users')
                    ->join('employees', 'users.id', '=', 'employees.user_id')
                    ->select('users.*', 'employees.birth_date', 'employees.gender')
                    ->get(); 
        $userList = DB::table('users')->get();

        // search by id
        if($request->user_id)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.id', '=', 'employees.user_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender')
                        ->where('user_id','LIKE','%'.$request->user_id.'%')
                        ->get();
        }
        // search by full_name
        if($request->full_name)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.id', '=', 'employees.user_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender')
                        ->where('users.full_name','LIKE','%'.$request->full_name.'%')
                        ->get();
        }
        // search by full_name
        if($request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.id', '=', 'employees.user_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }

        // search by full_name and id
        if($request->user_id && $request->full_name)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.id', '=', 'employees.user_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender')
                        ->where('user_id','LIKE','%'.$request->user_id.'%')
                        ->where('users.full_name','LIKE','%'.$request->full_name.'%')
                        ->get();
        }
        // search by position and id
        if($request->user_id && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.id', '=', 'employees.user_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender')
                        ->where('user_id','LIKE','%'.$request->user_id.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }
        // search by full_name and position
        if($request->full_name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.id', '=', 'employees.user_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender')
                        ->where('users.full_name','LIKE','%'.$request->full_name.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }
        // search by full_name and position and id
        if($request->user_id && $request->full_name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees', 'users.id', '=', 'employees.user_id')
                        ->select('users.*', 'employees.birth_date', 'employees.gender')
                        ->where('user_id','LIKE','%'.$request->user_id.'%')
                        ->where('users.full_name','LIKE','%'.$request->full_name.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }
        return view('form.employeelist',compact('users','userList'));
    }
}
