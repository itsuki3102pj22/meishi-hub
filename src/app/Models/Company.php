<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'name_kana',
        'industry',
        'phone',
        'website',
        'address',
        'memo'
    ];

    // ユーザーとのリレーション
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

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

    // ログインユーザーのデータのみを取得するグローバルスコープ
    protected static function booted(): void
    {
        static::addGlobalScope('user', function ($query) {
            if (auth()->check()) {
                $query->where('user_id', auth()->id());
            }
        });
    }
};
