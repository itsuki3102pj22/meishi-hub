@extends('layouts.app')
@section('title', $todo->title . ' - 編集')

@section('content')
<div class="space-y-6">
    <!-- ページヘッダー -->
    <div class="flex items-center gap-4">
        <a href="{{ route('todos.index') }}" class="text-slate-400 hover:text-emerald-600 transition">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 12H5m7-7l-7 7 7 7"/></svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-slate-900">タスクを編集</h2>
            <p class="text-sm text-slate-500 mt-0.5">{{ $todo->title }}</p>
        </div>
    </div>

    <!-- フォーム -->
    <form action="{{ route('todos.update', $todo) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- タスク情報 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">タスク内容</h4>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">タスク *</label>
                    <input type="text" name="title" value="{{ $todo->title }}" required
                           class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('title') border-red-500 @enderror">
                    @error('title')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">期限</label>
                        <input type="date" name="due_date" value="{{ $todo->due_date?->format('Y-m-d') }}"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('due_date') border-red-500 @enderror">
                        @error('due_date')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">紐付け先（案件）</label>
                        <select name="deal_id"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('deal_id') border-red-500 @enderror">
                            <option value="">選択しない</option>
                            @foreach($deals as $deal)
                                <option value="{{ $deal->id }}" {{ $todo->deal_id === $deal->id ? 'selected' : '' }}>
                                    {{ $deal->name }} - {{ $deal->company->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('deal_id')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">関連する名刺</label>
                    <select name="card_id"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('card_id') border-red-500 @enderror">
                        <option value="">選択しない</option>
                        @foreach($cards as $card)
                            <option value="{{ $card->id }}" {{ $todo->card_id === $card->id ? 'selected' : '' }}>
                                {{ $card->full_name }} - {{ $card->company->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('card_id')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <!-- ステータス -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">ステータス</h4>
            </div>
            <div class="p-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_done" value="1" {{ $todo->is_done ? 'checked' : '' }}
                           class="w-5 h-5 rounded border-2 border-slate-300 focus:ring-2 focus:ring-emerald-500 cursor-pointer">
                    <span class="text-sm font-semibold text-slate-700">完了したタスク</span>
                </label>
            </div>
        </div>

        <!-- フッター -->
        <div class="flex items-center gap-3">
            <button type="submit" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/></svg>
                保存
            </button>
            <a href="{{ route('todos.index') }}" class="flex items-center gap-2 px-6 py-2 border border-gray-200 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 transition">
                キャンセル
            </a>
            <form action="{{ route('todos.destroy', $todo) }}" method="POST" onsubmit="return confirm('このタスクを削除しますか？')" class="ml-auto inline">
                @csrf @method('DELETE')
                <button type="submit" class="flex items-center gap-2 px-6 py-2 border border-red-200 rounded-lg font-semibold text-red-600 hover:bg-red-50 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>
                    削除
                </button>
            </form>
        </div>
    </form>
</div>
@endsection
