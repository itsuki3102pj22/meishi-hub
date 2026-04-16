<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    protected $fillable = [
        'user_id',
        'deal_id',
        'card_id',
        'title',
        'due_date',
        'is_done',
    ];

    protected $casts = [
        'due_date' => 'date',
        'is_done' => 'boolean',
    ];

    // ToDoが所属する名刺を取得
    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    // ToDoが所属するDealを取得
    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

}
