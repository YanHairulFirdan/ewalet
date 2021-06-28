<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulletinRequest extends FormRequest
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
            'title'    => 'required|between:10,32',
            'body'     => 'required|between:10,200',
            'password' => 'nullable|size:4',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Your :attribute must be fill in',
            'between'  => 'Your :attribute must be :min to :max characters long',
            'size'     => 'Your :attribute must be :size digit',
        ];
    }
}
