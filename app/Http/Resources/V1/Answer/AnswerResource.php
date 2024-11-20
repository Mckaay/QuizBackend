<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Answer;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Answer */
final class AnswerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'question_id' => $this->question_id,
            'content' => $this->content,
            'is_correct' => $this->is_correct,
        ];
    }
}
