<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

final class UpdateController extends Controller
{
    public function __invoke(Request $request, Quiz $quiz): JsonResponse
    {
        DB::transaction(function () use ($request, $quiz): void {
            $quiz = $quiz->update($request->only(['title']));
        });

        return response()->json(
            data: [
                'status' => 'success',
                'message' => 'Quiz successfully updated.',
            ],
            status: Response::HTTP_OK,
        );
    }
}
