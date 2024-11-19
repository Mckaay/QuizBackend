<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Quiz\QuizCollection;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class IndexController extends Controller
{
    public function __invoke(Request $request): JsonResource
    {
        return new QuizCollection(resource: Quiz::paginate(15));
    }
}
