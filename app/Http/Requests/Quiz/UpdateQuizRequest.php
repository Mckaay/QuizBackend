<?php

declare(strict_types=1);

namespace App\Http\Requests\Quiz;

use App\Models\Quiz;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

final class UpdateQuizRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|unique:quizzes|max:255|string',
            'questions' => 'required|array',
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
        return $this->user()->can(abilities: 'update', arguments: Quiz::class);
    }

    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response: response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors(),
        ]));
    }

    public function prepareForValidation(): void
    {
        if (is_string($this->questions)) {
            $this->merge([
                'questions' => json_decode($this->questions, true),
            ]);
        }
    }
}
