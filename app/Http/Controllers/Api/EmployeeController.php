<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    try{
        $employees=Employee::with('company')->get();

        if(count($employees) != 0) {
            return (new EmployeeCollection($o));
        }
        else {
            return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"No Employees Found");
        }
    }
    catch(\Exception $e) {
        return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED,$e->getMessage());
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        try{
            $employee=new Employee;
            $employee->first_name=$request->first_name;
            $employee->last_name=$request->last_name;
            $employee->email=$request->email;
            $employee->phone=$request->phone;
            $employee->company_id=$request->company_id;
            $employee->save();
            return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"Employee Created Successfully!");

        }
        catch(\Exception $e){
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED,$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     try{   
        $employee=Employee::with('company')->findOrFail($id);
        if(isset($employee)) {
            return (new EmployeeResource($employee));
        }
        else {
            return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"No Employee Found!");
        }
    }
    catch(\Exception $e) {
        return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED,$e->getMessage());
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        try{
            $employee=Employee::findOrFail($id);
            $employee->first_name=$request->first_name;
            $employee->last_name=$request->last_name;
            $employee->email=$request->email;
            $employee->phone=$request->phone;
            $employee->company_id=$request->company_id;
            $employee->update();
            return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"Employee Updated Successfully!");

        }
        catch(\Exception $e){
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED,$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $employee=Employee::findOrFail($id);
            $employee->delete();
            return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"Employee Deleted Successfully!");

        }
        catch(\Exception $e){
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED,$e->getMessage());
        }
    }

    public function login() {
        if (Auth::attempt([
            'email' => request('email'),
            'password' => request('password'),
          
            ])) 
        {
            $user = Auth::user();
               
                return (new AuthResource($user));
            }
            else {
                return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, 'User Not Activated');
                
            }
           
           
        } 
        else {
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED, 'Incorrect Email or password');
        }
    }
}
