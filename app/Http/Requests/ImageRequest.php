<?php

namespace Banijya\Http\Requests;

use Banijya\Http\Requests\Request;

class ImageRequest extends Request
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
            'image' => 'required|mimes:jpeg,jpg,png,bmp|max:512'

        ];
    }

    public function messages()
    {
        return [
                'image.required' => 'You must select an image first.',
                'image.mimes' => 'Please select a proper image type, accepted are : JPG, PNG.',
                'image.max' => 'Image size should not exceed 512 Kilobytes.'
                ];
    }
}
