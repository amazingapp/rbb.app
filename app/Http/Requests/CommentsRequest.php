<?php

namespace Banijya\Http\Requests;

use Banijya\Http\Requests\Request;
use Banijya\Post;
use Illuminate\Contracts\Auth\Guard;
use Auth;

class CommentsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $post = Post::with('owner')->findOrFail($this->post_id);

        return $post->user_id == Auth::id() || Auth::user()->isFriendsWith($post->owner->id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => 'required|min:1',
        ];
    }

    public function messages()
    {
        return [
                'body.required' => 'You cannot submit empty comment.',
            ];
    }
}
