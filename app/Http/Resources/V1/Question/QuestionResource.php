<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Question;

use App\Http\Resources\V1\Answer\AnswerResource;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Question */
final class QuestionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'quiz_id' => $this->quiz_id,
            'content' => $this->content,
            'answers' => AnswerResource::collection(resource: $this->whenLoaded(relationship: 'answers')),
        ];
    }
}
