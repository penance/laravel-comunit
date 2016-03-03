<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DiscussionCreationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       // no need - got webAuthenticated middleware
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
            'title'     => 'required|min:3|unique:discussions,title',
            'proposal'  => 'required|min:3'
        ];
    }
}
