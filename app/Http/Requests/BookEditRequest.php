<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookEditRequest extends FormRequest
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
            'name' => "required",
            'isbn' => "nullable",
            'published_at' => "nullable",
            'publisher_id' => "nullable",
            'pdf' => "nullable|file",
            'image' => "nullable|file",
        ];
    }
}
