<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quiz\DeleteQuizRequest;
use App\Models\Quiz;
use App\Repositories\Quiz\QuizRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

final class DeleteController extends Controller
{
    public function __invoke(DeleteQuizRequest $request, Quiz $quiz, QuizRepository $quizRepository): JsonResponse
    {
        $deleted = $quizRepository->destroy($quiz);

        if ( ! $deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz not found.',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

        return response()->json(
            data: [
                'status' => 'success',
                'message' => 'Quiz deleted successfully',
            ],
            status: Response::HTTP_OK,
        );
    }
}
