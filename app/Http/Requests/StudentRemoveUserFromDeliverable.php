<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRemoveUserFromDeliverable extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->deliverable
            ->users()
            ->wherePivot('level', 'CREATOR')
            ->get()
            ->contains($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user' => 'exists:App\Models\User,id'
        ];
    }
}
