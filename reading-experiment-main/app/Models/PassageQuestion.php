<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $passage_id
 * @property string $title
 *
 * @property PassageQuestionOption & HasMany $questionOptions
 */
class PassageQuestion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function questionOptions(): HasMany
    {
        return $this->hasMany(PassageQuestionOption::class);
    }
}
