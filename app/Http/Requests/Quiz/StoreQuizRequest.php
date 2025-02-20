<?php

declare(strict_types=1);

namespace App\Http\Requests\Quiz;

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
            'description' => 'required|string|max:60',
            'time' => 'required|integer|max:2000',
            'questions' => 'required|array|min:2|max:10',
            'questions.*.content' => 'required|string',
            'questions.*.answers' => 'required|array|min:4|max:5',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Quiz title is required!',
            'title.unique' => 'Quiz with this title already exists!',
            'questions.*.content' => 'You need to add content to question!',
            'questions.*.answers' => 'You need to add at least 4 answers!',
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->can(abilities: 'create', arguments: Quiz::class);
    }

    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response: response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors(),
        ]));
    }
}
