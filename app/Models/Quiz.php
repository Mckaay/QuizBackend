<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\QuizObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(classes: QuizObserver::class)]
final class Quiz extends Model
{
    use HasFactory;
    use HasUlids;

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
