<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Quiz extends Model
{
    use HasFactory;
    use HasUlids;

    protected $guarded = [
        'timesPlayed',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
