<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isBest()
    {
        // ini fungsinya utk mengecek apakah answer ini adalah answer terbaik dari question ini
        return $this->id === $this->question->best_answer_id;
    }
}
