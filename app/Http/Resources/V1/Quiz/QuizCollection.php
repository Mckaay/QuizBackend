<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Quiz;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

final class QuizCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'status' => 'success',
            'data' => $this->collection,
        ];
    }
}
