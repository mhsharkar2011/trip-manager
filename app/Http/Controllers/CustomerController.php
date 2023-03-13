<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['customers'] = Customer::all();
        return view('customers.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
        ]);

        $customerObj = new Customer();

        if($request->hasFile('avatar')){
            $image = $request->file('avatar');
            $name = time().'.'.$image->getClientOriginalExtension();
            $path = public_path('/upload/customers');
            $image->move($path, $name);
            $customerObj->avatar = $name;
        }
        $customerObj->user_id = $request->first_name;
        $customerObj->first_name = $request->first_name;
        $customerObj->last_name = $request->last_name;
        $customerObj->contact_number = $request->contact_number;
        $customerObj->save();

        return redirect()->route('admin.customers.index')->with('success', 'Customer Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['customer'] = Customer::find($id);
        return view('customers.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $user = User::all();
        return view('customers.edit',compact('customer','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $validation = Validator::make(
            $request->all(), 
            Customer::validation_rules_for_update(),
            Customer::validation_messages_for_update(),
        );

        if ($validation->fails()) {
            return $this->respondValidationError($validation->errors());
        }   

        $customer->update($request->all());

        return redirect()->route('admin.customers.index')->with('success', 'Customer Added Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        if(request()->is('api*')){
            return $this->respond($customer);
        }else{
            return view('admin.customers.index',['customers'=>$customer]);
        }
    }
}
