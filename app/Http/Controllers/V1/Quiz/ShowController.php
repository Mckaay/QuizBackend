<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Quiz\QuizResource;
use App\Models\Quiz;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class ShowController extends Controller
{
    public function __invoke(Request $request, Quiz $quiz): JsonResponse
    {
        return response()->json(
            data: [
                'status' => 'success',
                'data' => new QuizResource($quiz),
            ],
            status: Response::HTTP_OK,
        );
    }
}
