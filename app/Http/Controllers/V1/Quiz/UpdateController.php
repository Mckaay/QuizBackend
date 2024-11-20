<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quiz\UpdateQuizRequest;
use App\Models\Quiz;
use App\Repositories\Quiz\QuizRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class UpdateController extends Controller
{
    public function __invoke(UpdateQuizRequest $request, Quiz $quiz, QuizRepository $quizRepository): JsonResponse
    {
        $quizRepository->update($request->validated(), $quiz);

        return response()->json(
            data: [
                'status' => 'success',
                'message' => 'Quiz successfully updated.',
            ],
            status: Response::HTTP_OK,
        );
    }
}
