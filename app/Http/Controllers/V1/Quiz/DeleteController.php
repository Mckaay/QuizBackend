<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

final class DeleteController extends Controller
{
    public function __invoke(Quiz $quiz): JsonResponse
    {
        DB::transaction(function () use ($quiz): void {
            $quiz->delete();
        });

        return response()->json(
            data: [
                'status' => 'success',
                'message' => 'Quiz deleted successfully',
            ],
            status: Response::HTTP_OK,
        );
    }
}
