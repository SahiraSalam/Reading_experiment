<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Survey;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property string $back_times
 */
class UserProgress extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'page_number', 'start_time', 'end_time'];
    public $timestamps = false;
    public function survey()
    {
        return $this->belongsTo(Survey::class, 'survey_id'); // Ensure you have survey_id column
    }

    public function passage(): BelongsTo
    {
        return $this->belongsTo(Passage::class, 'passage_id');

    }

    public function style(): BelongsTo
    {
        return $this->belongsTo(PassageStyle::class, 'passage_style_id');

    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = Carbon::now()->timestamp * 1000000 + Carbon::now()->micro;

        });

        static::updating(function ($model) {
            $timestamp = Carbon::now()->timestamp * 1000000 + Carbon::now()->micro;
            $model->updated_at = $timestamp;
        });
    }


}
