<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class IncrementQuizPlaysController extends Controller
{
    public function __invoke(Request $request, string $id): JsonResponse
    {
        Quiz::query()->where('id', $id)->increment('timesPlayed');

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
