
@extends('layouts.app')
@section('title', $deal->name)

@section('content')
<div class="space-y-6">
    <!-- ページヘッダー -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('deals.index') }}" class="text-slate-400 hover:text-emerald-600 transition">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 12H5m7-7l-7 7 7 7"/></svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-slate-900">{{ $deal->name }}</h2>
                <p class="text-sm text-slate-500 mt-0.5">{{ $deal->company->name }}</p>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('deals.edit', $deal) }}"
               class="flex items-center gap-1 px-4 py-2 border border-gray-200 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z"/></svg>
                編集
            </a>
            <form action="{{ route('deals.destroy', $deal) }}" method="POST" onsubmit="return confirm('この案件を削除しますか？')" class="inline">
                @csrf @method('DELETE')
                <button type="submit" class="flex items-center gap-1 px-4 py-2 border border-red-200 rounded-lg text-sm font-semibold text-red-600 hover:bg-red-50 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>
                    削除
                </button>
            </form>
        </div>
    </div>

    <!-- 統計情報 -->
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">ステータス</p>
            @php
            $statusLabels = [
                'lead' => 'リード',
                'proposal' => '提案中',
                'negotiation' => '商談中',
                'won' => '受注済み',
                'lost' => '失注',
            ];
            $statusColors = [
                'lead' => 'bg-slate-100 text-slate-700',
                'proposal' => 'bg-amber-100 text-amber-700',
                'negotiation' => 'bg-emerald-100 text-emerald-700',
                'won' => 'bg-blue-100 text-blue-700',
                'lost' => 'bg-red-100 text-red-700',
            ];
            @endphp
            <span class="inline-block text-sm px-3 py-1 rounded font-semibold {{ $statusColors[$deal->status] ?? 'bg-slate-100' }}">
                {{ $statusLabels[$deal->status] ?? $deal->status }}
            </span>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">金額</p>
            <h4 class="text-2xl font-bold text-slate-900">{{ $deal->amount ? '¥' . number_format($deal->amount) : '未定' }}</h4>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">進捗率</p>
            <h4 class="text-2xl font-bold text-slate-900">{{ $deal->progress }}%</h4>
        </div>
    </div>

    <!-- 2段レイアウト -->
    <div class="grid grid-cols-2 gap-4">
        <!-- 案件詳細 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">案件詳細</h4>
            </div>
            <div class="divide-y divide-gray-50">
                <div class="px-6 py-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">クローズ予定日</p>
                    <p class="text-sm text-slate-700">{{ $deal->close_date ? $deal->close_date->format('Y年m月d日') : '未設定' }}</p>
                </div>
                <div class="px-6 py-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">担当者</p>
                    @if($deal->card)
                        <a href="{{ route('cards.show', $deal->card) }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                            {{ $deal->card->full_name }}
                        </a>
                        <p class="text-xs text-slate-500 mt-1">{{ $deal->card->position }}</p>
                    @else
                        <p class="text-sm text-slate-500">未設定</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- メモ -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">メモ・備考</h4>
            </div>
            <div class="px-6 py-4">
                <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $deal->memo ?? 'メモはありません' }}</p>
            </div>
        </div>
    </div>

    <!-- Todo セクション -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h4 class="text-sm font-bold text-slate-800">関連タスク（{{ $deal->todos->count() }}件）</h4>
        </div>
        @if($deal->todos->isEmpty())
            <div class="px-6 py-8 text-center text-slate-400 text-sm">
                <svg class="w-12 h-12 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                タスクがありません
            </div>
        @else
            <div class="divide-y divide-gray-50">
                @foreach($deal->todos as $todo)
                <div class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition-colors group">
                    <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="flex-shrink-0">
                        @csrf @method('PATCH')
                        <button type="submit" class="w-5 h-5 rounded border-2 flex items-center justify-center transition {{ $todo->is_done ? 'bg-emerald-500 border-emerald-500' : 'border-slate-300 hover:border-emerald-500' }}">
                            @if($todo->is_done)
                                <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            @endif
                        </button>
                    </form>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-slate-800 {{ $todo->is_done ? 'line-through text-slate-400' : '' }}">{{ $todo->title }}</p>
                    </div>
                    <div class="flex items-center gap-2 flex-shrink-0">
                        @if($todo->due_date)
                        <span class="text-xs {{ $todo->due_date->isPast() && !$todo->is_done ? 'text-red-500 font-semibold' : 'text-slate-400' }}">
                            {{ $todo->due_date->format('m/d') }}
                        </span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @endif
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            <form action="{{ route('todos.store') }}" method="POST" class="flex gap-2">
                @csrf
                <input type="hidden" name="deal_id" value="{{ $deal->id }}">
                <input type="hidden" name="redirect" value="{{ route('deals.show', $deal) }}">
                <input type="text" name="title" placeholder="新しいタスクを追加..."
                       class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                <button type="submit" class="flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
