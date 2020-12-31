<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommitteeCreateProjectRequest extends FormRequest
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
            'name' => 'required|max:255',
            'project-chiefs' => 'required|array|size:1',
            'project-chiefs.*' => 'exists:users,id', 
            'groups' => 'required|array|min:1',
            'groups.*' => 'exists:groups,id', 
        ];
    }
}
