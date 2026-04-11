<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'name',
        'name_kana',
        'industry',
        'phone',
        'website',
        'address',
        'memo'
    ];

    // 会社に関連する名刺を取得
    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    // 会社に関連する商談を取得
    public function deals(): HasMany
    {
        return $this->hasMany(Deal::class);
    }
};
