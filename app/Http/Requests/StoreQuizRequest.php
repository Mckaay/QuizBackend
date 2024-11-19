<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Quiz;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

final class StoreQuizRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|unique:quizzes|max:255|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Quiz title is required',
            'title.unique' => 'Quiz with this title already exists',
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->can('create', Quiz::class);
    }

    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors(),
        ]));
    }
}
