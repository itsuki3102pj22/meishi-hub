mkdir -p ~/meishi-hub/src/resources/views/todos

@extends('layouts.app')
@section('title', 'Todo一覧')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div class="text-sm text-gray-400">
        未完了 {{ $todos->where('is_done', false)->count() }}件
        ／ 完了 {{ $todos->where('is_done', true)->count() }}件
    </div>
    <a href="{{ route('todos.create') }}"
       class="flex items-center gap-1 bg-emerald-500 text-white text-sm px-3 py-1.5 rounded-lg hover:bg-emerald-600 transition">
        + Todoを追加
    </a>
</div>

{{-- 未完了 --}}
<div class="bg-white border border-gray-100 rounded-xl p-5 mb-4">
    <div class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-4">未完了</div>
    @forelse($todos->where('is_done', false) as $todo)
    <div class="flex items-center gap-3 py-2.5 border-b border-gray-50 last:border-0">
        <form action="{{ route('todos.toggle', $todo) }}" method="POST">
            @csrf @method('PATCH')
            <button type="submit"
                    class="w-4 h-4 border border-gray-300 rounded flex items-center justify-center hover:border-emerald-500 transition flex-shrink-0">
            </button>
        </form>
        <span class="text-sm flex-1">{{ $todo->title }}</span>
        @if($todo->deal)
            <a href="{{ route('deals.show', $todo->deal) }}"
               class="text-xs bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded-full hover:bg-emerald-100 transition">
                {{ $todo->deal->name }}
            </a>
        @endif
        @if($todo->card)
            <a href="{{ route('cards.show', $todo->card) }}"
               class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full hover:bg-gray-200 transition">
                {{ $todo->card->full_name }}
            </a>
        @endif
        @if($todo->due_date)
            <span class="text-xs {{ $todo->due_date->isPast() ? 'text-red-400' : 'text-gray-400' }}">
                {{ $todo->due_date->format('m/d') }}
            </span>
        @endif
        <form action="{{ route('todos.destroy', $todo) }}" method="POST"
              onsubmit="return confirm('削除しますか？')">
            @csrf @method('DELETE')
            <button type="submit" class="text-gray-300 hover:text-red-400 transition text-xs">✕</button>
        </form>
    </div>
    @empty
        <div class="text-sm text-gray-400 py-2">未完了のTodoはありません</div>
    @endforelse
</div>

{{-- 完了済み --}}
@if($todos->where('is_done', true)->count() > 0)
<div class="bg-white border border-gray-100 rounded-xl p-5">
    <div class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-4">完了済み</div>
    @foreach($todos->where('is_done', true) as $todo)
    <div class="flex items-center gap-3 py-2.5 border-b border-gray-50 last:border-0">
        <form action="{{ route('todos.toggle', $todo) }}" method="POST">
            @csrf @method('PATCH')
            <button type="submit"
                    class="w-4 h-4 bg-emerald-500 border border-emerald-500 rounded flex items-center justify-center flex-shrink-0">
                <svg class="w-2.5 h-2.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
            </button>
        </form>
        <span class="text-sm flex-1 line-through text-gray-400">{{ $todo->title }}</span>
        <form action="{{ route('todos.destroy', $todo) }}" method="POST"
              onsubmit="return confirm('削除しますか？')">
            @csrf @method('DELETE')
            <button type="submit" class="text-gray-300 hover:text-red-400 transition text-xs">✕</button>
        </form>
    </div>
    @endforeach
</div>
@endif
@endsection