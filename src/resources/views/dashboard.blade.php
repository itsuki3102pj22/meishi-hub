@extends('layouts.app')
@section('title', 'ダッシュボード')

@section('content')
{{-- KPIカード --}}
<div class="grid grid-cols-4 gap-3 mb-6">
    <div class="bg-gray-50 rounded-xl p-4">
        <div class="text-xs text-gray-400 mb-1">総名刺数</div>
        <div class="text-2xl font-medium">{{ $stats['cards'] }}</div>
    </div>
    <div class="bg-gray-50 rounded-xl p-4">
        <div class="text-xs text-gray-400 mb-1">会社数</div>
        <div class="text-2xl font-medium">{{ $stats['companies'] }}</div>
    </div>
    <div class="bg-gray-50 rounded-xl p-4">
        <div class="text-xs text-gray-400 mb-1">進行中の案件</div>
        <div class="text-2xl font-medium">{{ $stats['deals'] }}</div>
    </div>
    <div class="bg-gray-50 rounded-xl p-4">
        <div class="text-xs text-gray-400 mb-1">売上見込み</div>
        <div class="text-2xl font-medium">¥{{ number_format($stats['amount']) }}</div>
    </div>
</div>

<div class="grid grid-cols-2 gap-4 mb-4">
    {{-- 最近の名刺 --}}
    <div class="bg-white border border-gray-100 rounded-xl p-5">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-medium">最近登録した名刺</span>
            <a href="{{ route('companies.index') }}" class="text-xs text-emerald-600">すべて見る →</a>
        </div>
        @foreach($recentCards as $card)
        <a href="{{ route('cards.show', $card) }}" class="flex items-center gap-3 py-2 border-b border-gray-50 last:border-0 hover:bg-gray-50 -mx-2 px-2 rounded">
            <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-xs font-medium text-emerald-800 flex-shrink-0">
                {{ mb_substr($card->last_name, 0, 1) }}
            </div>
            <div class="flex-1">
                <div class="text-sm">{{ $card->full_name }}</div>
                <div class="text-xs text-gray-400">{{ $card->company->name }} / {{ $card->position }}</div>
            </div>
            <div class="text-xs text-gray-400">{{ $card->created_at->diffForHumans() }}</div>
        </a>
        @endforeach
    </div>

    {{-- 案件の進捗 --}}
    <div class="bg-white border border-gray-100 rounded-xl p-5">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-medium">案件の進捗</span>
            <a href="{{ route('deals.index') }}" class="text-xs text-emerald-600">すべて見る →</a>
        </div>
        @foreach($recentDeals as $deal)
        <a href="{{ route('deals.show', $deal) }}" class="flex items-center gap-3 py-2 border-b border-gray-50 last:border-0 hover:bg-gray-50 -mx-2 px-2 rounded">
            <div class="flex-1">
                <div class="text-sm">{{ $deal->name }}</div>
                <div class="text-xs text-gray-400">{{ $deal->company->name }}</div>
            </div>
            @php
                $statusColors = [
                    'lead' => 'bg-gray-100 text-gray-600',
                    'proposal' => 'bg-amber-50 text-amber-800',
                    'negotiation' => 'bg-emerald-50 text-emerald-800',
                    'won' => 'bg-blue-50 text-blue-800',
                    'lost' => 'bg-red-50 text-red-800',
                ];
            @endphp
            <span class="text-xs px-2 py-0.5 rounded-full {{ $statusColors[$deal->status] ?? 'bg-gray-100' }}">
                {{ $deal->status_label }}
            </span>
            <div class="text-sm font-medium text-gray-700">¥{{ number_format($deal->amount) }}</div>
        </a>
        @endforeach
    </div>
</div>

{{-- Todo --}}
<div class="bg-white border border-gray-100 rounded-xl p-5">
    <div class="text-sm font-medium mb-4">未完了のTodo</div>
    @foreach($todos as $todo)
    <div class="flex items-center gap-3 py-2 border-b border-gray-50 last:border-0">
        <form action="{{ route('todos.toggle', $todo) }}" method="POST">
            @csrf @method('PATCH')
            <button type="submit" class="w-4 h-4 border border-gray-300 rounded flex items-center justify-center hover:border-emerald-500 transition"></button>
        </form>
        <span class="text-sm flex-1">{{ $todo->title }}</span>
        @if($todo->due_date)
            <span class="text-xs text-gray-400">{{ $todo->due_date->format('m/d') }}</span>
        @endif
    </div>
    @endforeach
</div>
@endsection
