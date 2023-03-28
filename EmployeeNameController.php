<?php

namespace App\Http\Controllers;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeNameRequest;
use App\Services\EmployeeNameService;


class EmployeeNameController extends Controller
{
    use ResponseTrait;
    public $employee_name_service;
    public function __construct(EmployeeNameService $employee_name_service){
        $this->employee_name_service = $employee_name_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return $this->employee_name_service->loadEmployeeNames();
        $result = $this->successResponse('Load Successfully!');
        try {
            $result["data"] = $this->employee_name_service->loadEmployeeNames();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeNameRequest $employee_name_request)
    {
        $result = $this->successResponse('Stored Successfully!');
        try {
            $data=[
                "first_name" => $employee_name_request->first_name,
                "last_name" => $employee_name_request->last_name,
                "middle_name" => $employee_name_request->middle_name,
                "employee_number" => $employee_name_request->employee_number,
                "section_id" => $employee_name_request->section_id,
            ];
            $this->employee_name_service->storeEmployeeName($data);
        } catch (\Exception $e) {
            $result= $this->errorResponse($e);
        }
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->successResponse('Showed Successfully!');
        try {
            $result["data"] = $this->employee_name_service->showEmployeeName($id);
        } catch (\Exception $e) {
            $result= $this->errorResponse($e);
        }
        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeNameRequest $employee_name_request, $id)
    {
        $result = $this->successResponse('Updated Successfully!');
        try {
            $data = [
                "first_name" => $employee_name_request->first_name,
                "last_name" => $employee_name_request->last_name,
                "middle_name" => $employee_name_request->middle_name,
                "section_id" => $employee_name_request->section_id,
            ];
            $this->employee_name_service->updateEmployeeName($id, $data);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->successResponse('Deleted Successfully!');
        try {
            $this->employee_name_service->deleteEmployeeName($id);
        } catch (\Exception $e) {
            $result= $this->errorResponse($e);
        }
        return $result;
    }
}
