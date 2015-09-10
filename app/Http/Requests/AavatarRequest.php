<?php

namespace Banijya\Http\Requests;

use Banijya\Http\Requests\Request;

class AavatarRequest extends Request
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
            'aavatar' => 'required|mimes:jpeg,jpg,png,bmp|max:512'

        ];
    }

    public function messages()
    {
        return [
                'aavatar.required' => 'You must select an image first.',
                'aavatar.mimes' => 'Please select a proper image type, accepted are : JPG, PNG.',
                ];
    }
}
