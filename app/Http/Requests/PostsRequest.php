<?php

namespace Banijya\Http\Requests;

use Banijya\Http\Requests\Request;

class PostsRequest extends Request
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
            'body' => 'required|min:1'
        ];
    }

    public function messages()
    {
        return[
                    'body.required' => 'You cannot post an empty status.',
                    'body.min'  => 'You should at least type a letter.'
            ];
    }
}
