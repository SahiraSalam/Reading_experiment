<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Survey;

class Consent extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'accepted'];
    
    public function survey()
    {
        return $this->belongsTo(Survey::class, 'user_id');
    }
}
