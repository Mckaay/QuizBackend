<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Quiz;

use App\Http\Resources\V1\Question\QuestionResource;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Quiz */
final class QuizResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'questions' => QuestionResource::collection(
                resource: $this->whenLoaded(
                    relationship: 'questions',
                ),
            ),
            'icon' => $this->icon ?? 'no-icon',
        ];
    }
}
