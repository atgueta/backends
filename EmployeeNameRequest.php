<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmployeeNameRequest extends FormRequest
{
    use ResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "first_name" => "required",
            "last_name" => "required",
            "middle_name" => "required",
            "employee_number" => $this->method() === "POST" ? "required|unique:employee_names,employee_number,NULL,employee_number" :"",
        ];
    }

    public function messages(){
        return [
            "first_name.required" => "First name must have data",
            "last_name.required" => "Last name must have data",
            "middle_name.required" => "Middle name must have data",
            "employee_number.required" => "Employee number name must have data",
            "employee_number.unique" => "Employee already registered.",
        ];
    }
    public function failedValidation(Validator $validator){
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response));

    }
}
