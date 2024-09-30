<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany as RelationsBelongsToMany;

class JobTag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function job(): RelationsBelongsToMany
    {
        return $this->belongToMany(Job::class)->withTimestamps();
    }
}
