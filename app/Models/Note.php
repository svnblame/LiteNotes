<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'user_id', 'title', 'text'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
