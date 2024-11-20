<?php

declare(strict_types=1);

namespace App\Http\Requests\Quiz;

use App\Models\Quiz;
use Illuminate\Foundation\Http\FormRequest;

final class DeleteQuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can(abilities: 'delete', arguments: Quiz::class);
    }
}
