<?php

namespace App\Api\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request object for update post.
 */
class PostUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'short_description' => 'sometimes|required|string|max:2000',
            'description' => 'sometimes|required|string|max:10000',
        ];
    }
}
