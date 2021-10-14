<?php

namespace App\Http\Controllers\Api;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Http\Resources\CompanyCollection;
use App\Http\Resources\CompanyResource;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        try{
            $companies=Company::all();
               
            if(count($companies) != 0) {
                return (new CompanyCollection($companies));
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"No Companies Found");
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
    public function store(CompanyRequest $request)
    {
        try{
            $company=new Company;
            $company->name=$request->name;
            $company->email=$request->email;
            $company->website=$request->website;
            $company->save();
            return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"Company Created Successfully!");

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
            $company=Company::findOrFail($id);
            if(isset($company)) {
                return (new CompanyResource($company));
            }
            else {
                return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"No Company Found!");
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
    public function update(CompanyRequest $request, $id)
    {
        try{
            $company=Company::findOrFail($id);
            $company->name=$request->name;
            $company->email=$request->email;
            $company->website=$request->website;
            $company->update();
            return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"Company Updated Successfully!");

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
            $company=Company::findOrFail($id);
            $company->delete();
            return ApiHelper::apiResult(true,HttpResponse::HTTP_OK,"Company Deleted Successfully!");

        }
        catch(\Exception $e){
            return ApiHelper::apiResult(false,HttpResponse::HTTP_UNAUTHORIZED,$e->getMessage());
        }
    }
}
