@extends('layouts.app')
@section('title', $todo->title)

@section('content')
<div class="space-y-6">
    <!-- ページヘッダー -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('todos.index') }}" class="text-slate-400 hover:text-emerald-600 transition">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 12H5m7-7l-7 7 7 7"/></svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-slate-900">{{ $todo->title }}</h2>
                <p class="text-sm text-slate-500 mt-0.5">タスク詳細</p>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('todos.edit', $todo) }}"
               class="flex items-center gap-1 px-4 py-2 border border-gray-200 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z"/></svg>
                編集
            </a>
            <form action="{{ route('todos.destroy', $todo) }}" method="POST" onsubmit="return confirm('このタスクを削除しますか？')" class="inline">
                @csrf @method('DELETE')
                <button type="submit" class="flex items-center gap-1 px-4 py-2 border border-red-200 rounded-lg text-sm font-semibold text-red-600 hover:bg-red-50 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>
                    削除
                </button>
            </form>
        </div>
    </div>

    <!-- タスク情報 -->
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">ステータス</p>
            <div class="flex items-center gap-2">
                <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="w-5 h-5 rounded border-2 flex items-center justify-center transition {{ $todo->is_done ? 'bg-emerald-500 border-emerald-500' : 'border-slate-300 hover:border-emerald-500' }}">
                        @if($todo->is_done)
                            <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        @endif
                    </button>
                </form>
                <span class="text-sm font-semibold {{ $todo->is_done ? 'text-emerald-600' : 'text-slate-600' }}">
                    {{ $todo->is_done ? '完了' : '未完了' }}
                </span>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">期限</p>
            <p class="text-sm font-semibold {{ $todo->due_date && $todo->due_date->isPast() && !$todo->is_done ? 'text-red-600' : 'text-slate-700' }}">
                {{ $todo->due_date ? $todo->due_date->format('Y年m月d日') : '未設定' }}
            </p>
        </div>

        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">作成日</p>
            <p class="text-sm font-semibold text-slate-700">{{ $todo->created_at->format('Y年m月d日') }}</p>
        </div>
    </div>

    <!-- 関連情報 -->
    @if($todo->deal || $todo->card)
    <div class="grid grid-cols-2 gap-4">
        @if($todo->deal)
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">関連案件</h4>
            </div>
            <div class="px-6 py-4">
                <a href="{{ route('deals.show', $todo->deal) }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                    {{ $todo->deal->name }}
                </a>
                <p class="text-xs text-slate-500 mt-1">{{ $todo->deal->company->name }}</p>
                <p class="text-xs text-slate-500 mt-2">
                    <span class="inline-block px-2 py-1 bg-slate-100 text-slate-700 rounded text-xs font-semibold">
                        {{ $todo->deal->status }}
                    </span>
                </p>
            </div>
        </div>
        @endif

        @if($todo->card)
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">関連名刺</h4>
            </div>
            <div class="px-6 py-4">
                <a href="{{ route('cards.show', $todo->card) }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                    {{ $todo->card->full_name }}
                </a>
                <p class="text-xs text-slate-500 mt-1">{{ $todo->card->company->name }}</p>
                <p class="text-xs text-slate-500 mt-1">{{ $todo->card->position }}</p>
            </div>
        </div>
        @endif
    </div>
    @endif
</div>
@endsection
