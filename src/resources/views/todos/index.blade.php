@extends('layouts.app')
@section('title', 'Todo管理')

@section('content')
<div class="space-y-6">
    <!-- ページヘッダー -->
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-slate-900 mb-1">全タスク</h3>
            <p class="text-sm text-slate-500">登録されているタスク一覧</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="px-4 py-2 bg-emerald-50 text-emerald-700 rounded-lg text-sm font-semibold">
                {{ $todos->where('is_done', false)->count() }}件
            </span>
            <a href="{{ route('todos.create') }}"
               class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                タスクを追加
            </a>
        </div>
    </div>

    <!-- 未完了タスク -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100">
            <h4 class="text-sm font-bold text-slate-800">未完了タスク（{{ $todos->where('is_done', false)->count() }}件）</h4>
        </div>
        
        @forelse($todos->where('is_done', false) as $todo)
        <div class="flex items-center gap-4 px-6 py-4 border-b border-gray-50 last:border-b-0 hover:bg-gray-50 transition-colors group">
            <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="flex-shrink-0">
                @csrf @method('PATCH')
                <button type="submit" class="w-5 h-5 rounded border-2 border-slate-300 flex items-center justify-center hover:border-emerald-500 transition group-hover:border-emerald-500 bg-white">
                    <span class="text-emerald-600 text-sm opacity-0 group-hover:opacity-100 transition-opacity">✓</span>
                </button>
            </form>
            <div class="flex-1">
                <h6 class="text-sm font-semibold text-slate-800">{{ $todo->title }}</h6>
                @if($todo->deal)
                <p class="text-xs text-slate-500 mt-1">案件: {{ $todo->deal->name }}</p>
                @elseif($todo->card)
                <p class="text-xs text-slate-500 mt-1">名刺: {{ $todo->card->full_name }} ({{ $todo->card->company->name }})</p>
                @endif
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
                @if($todo->due_date)
                <div class="flex items-center gap-1 text-slate-400">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                    <span class="text-[10px]">{{ $todo->due_date->format('m/d') }}</span>
                </div>
                @endif
                <a href="{{ route('todos.edit', $todo) }}" class="text-slate-300 hover:text-emerald-600 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z"/></svg>
                </a>
            </div>
        </div>
        @empty
        <div class="px-6 py-12 text-center">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-slate-400 text-sm">まだタスクがありません</p>
        </div>
        @endforelse
    </div>

    <!-- 完了したタスク -->
    @if($todos->where('is_done', true)->count() > 0)
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100">
            <h4 class="text-sm font-bold text-slate-800">完了したタスク（{{ $todos->where('is_done', true)->count() }}件）</h4>
        </div>
        
        @foreach($todos->where('is_done', true) as $todo)
        <div class="flex items-center gap-4 px-6 py-4 border-b border-gray-50 last:border-b-0 hover:bg-gray-50 transition-colors group">
            <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="flex-shrink-0">
                @csrf @method('PATCH')
                <button type="submit" class="w-5 h-5 rounded border-2 border-emerald-500 bg-emerald-500 flex items-center justify-center hover:border-emerald-600 transition group-hover:border-emerald-600">
                    <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </button>
            </form>
            <div class="flex-1">
                <h6 class="text-sm font-semibold text-slate-500 line-through">{{ $todo->title }}</h6>
                @if($todo->deal)
                <p class="text-xs text-slate-400 mt-1">案件: {{ $todo->deal->name }}</p>
                @elseif($todo->card)
                <p class="text-xs text-slate-400 mt-1">名刺: {{ $todo->card->full_name }} ({{ $todo->card->company->name }})</p>
                @endif
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
                @if($todo->due_date)
                <div class="flex items-center gap-1 text-slate-300">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                    <span class="text-[10px]">{{ $todo->due_date->format('m/d') }}</span>
                </div>
                @endif
                <form action="{{ route('todos.destroy', $todo) }}" method="POST" onsubmit="return confirm('このタスクを削除しますか？')" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-slate-300 hover:text-red-600 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
