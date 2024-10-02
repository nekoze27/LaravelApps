<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaryFoodItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'daily_entry_id',
        'food_id',
        'quantity',
    ];

    public function diaryEntry()
    {
        return $this->belongsTo(DiaryEntry::class, 'diary_entry_id');
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
}
