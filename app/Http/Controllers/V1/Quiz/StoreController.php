<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quiz\StoreQuizRequest;
use App\Repositories\Quiz\QuizRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class StoreController extends Controller
{
    public function __invoke(StoreQuizRequest $request, QuizRepository $quizRepository): JsonResponse
    {
        $quizRepository->store(data: $request->validated());

        return response()->json(
            data: [
                'status' => 'success',
                'message' => 'Quiz was created',
            ],
            status: Response::HTTP_CREATED,
        );
    }
}
