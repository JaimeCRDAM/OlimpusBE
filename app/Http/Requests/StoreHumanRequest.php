<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHumanRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ["required"],
            'email' => ["required", "email", "unique:humans,email"],
            'password' => ["required", "string", "min:6"],
            'fate' => ['prohibited'],
            'god_id' => ['prohibited'],
            'wisdom' => ['prohibited'],
            'nobility' => ['prohibited'],
            'virtue' => ['prohibited'],
            'wickedness' => ['prohibited'],
            'audacity' => ['prohibited'],
            'alive' => ['prohibited'],
            'destiny' => ['prohibited']
        ];
    }
}
