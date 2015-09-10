<?php

namespace Banijya\Http\Requests;

use Banijya\Http\Requests\Request;
use Auth;
class ProfileRequest extends Request
{
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
            'name' => 'required',
            'employee_id' => 'required|numeric',
            'mobile' => 'numeric',
            // 'designation' => '',
            // 'current_branch' => '',
            'email' => 'required|email|unique:users,email,'. Auth::id(),
            'dob' => 'date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
                    'employee_id.required' => 'Your Employee Id is required.',
                    'employee_id.numeric' =>'Employee Id must be a number.',
                    'dob' => 'Your date of birth should be in Y-M-D format',
                ];
    }
}
