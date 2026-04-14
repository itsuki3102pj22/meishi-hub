<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deal extends Model
{
    protected $fillable = [
        'company_id',
        'card_id',
        'name',
        'status',
        'amount',
        'progress',
        'close_date',
        'memo'
    ];

    // 商談相手の会社を取得
    protected $casts = [
        'close_date' => 'date',
        'amount' => 'integer',
        'progress' => 'integer',
    ];

    // 商談状況のラベル
    const STATUS_LABELS = [
        'lead' => 'リード',
        'proposal' => '提案中',
        'negotiation' => '商談中',
        'won' => '受注済み',
        'lost' => '失注',
    ];

    // 商談に関連する会社を取得
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    // 商談に関連する名刺を取得
    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    // 商談に関連するToDoを取得
    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }

    // 商談状況のラベル取得
    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }
}
