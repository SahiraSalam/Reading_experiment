<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $text_name
 * @property string $topic
 * @property string $content
 *
 * @property PassageQuestion & HasMany $questions
 */
class Passage extends Model
{
    use HasFactory;

    protected $guarded = [];

    const INITIAL_READ = true;

    public function questions(): HasMany
    {
        return $this->hasMany(PassageQuestion::class);
    }



}
