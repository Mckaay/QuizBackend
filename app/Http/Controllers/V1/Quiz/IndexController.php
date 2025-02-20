<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Quiz\QuizResource;
use App\Repositories\Quiz\QuizRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class IndexController extends Controller
{
    public function __invoke(Request $request, QuizRepository $quizRepository): AnonymousResourceCollection
    {
        $validated = $request->validate([
            'searchQuery' => 'nullable|string|max:100',
        ]);

        $searchQuery = $validated['searchQuery'] ?? '';

        return QuizResource::collection(
            $quizRepository->getAll(searchQuery: $searchQuery),
        );
    }
}
