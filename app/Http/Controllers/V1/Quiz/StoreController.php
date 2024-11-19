<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuizRequest;
use App\Models\Quiz;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

final class StoreController extends Controller
{
    public function __invoke(StoreQuizRequest $request): JsonResponse
    {
        DB::transaction(callback: function () use ($request): void {
            $quiz = Quiz::create($request->validated());
        });

        return response()->json(
            data: [
                'status' => 'success',
                'message' => 'Quiz was created',
            ],
            status: Response::HTTP_CREATED,
        );
    }
}
