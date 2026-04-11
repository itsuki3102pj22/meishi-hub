<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    protected $fillable = [
        'deal_id',
        'card_id',
        'title',
        'due_date',
        'is_done',
    ];

    // ToDoが所属するDealを取得
    public function deals(): BelongsTo
    {
        return $this->belongsTo(Deal::class);
    }

    // ToDoが所属する名刺を取得
    public function cards(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
}
