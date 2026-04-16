<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'last_name',
        'first_name',
        'last_name_kana',
        'first_name_kana',
        'department',
        'position',
        'email',
        'phone',
        'mobile',
        'fax',
        'memo',
        'image_path'
    ];

    // ユーザーとのリレーション
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // 名刺が所属する会社を取得
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    // 名刺に関連する商談を取得
    public function deals(): HasMany
    {
        return $this->hasMany(Deal::class);
    }

    // 名刺に関連するToDoを取得
    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }

    // フルネームを取得
    public function getFullNameAttribute(): string
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    public function getInitialsAttribute(): string
    {
        return mb_substr($this->last_name, 0, 1) . mb_substr($this->first_name, 0, 1);
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
}
