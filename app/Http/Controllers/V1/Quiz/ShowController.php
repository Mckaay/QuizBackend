<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Quiz;

final class ShowController extends Controller
{
    public function __invoke(Quiz $quiz): Quiz
    {
        return $quiz;
    }
}
