
@extends('layouts.app')
@section('title', 'Todoを追加')

@section('content')
<div class="space-y-6">
    <!-- ページヘッダー -->
    <div class="flex items-center gap-4">
        <a href="{{ route('todos.index') }}" class="text-slate-400 hover:text-emerald-600 transition">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 12H5m7-7l-7 7 7 7"/></svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-slate-900">新規タスクを追加</h2>
            <p class="text-sm text-slate-500 mt-0.5">やることを登録します</p>
        </div>
    </div>

    <!-- フォーム -->
    <form action="{{ route('todos.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- タスク情報 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">タスク内容</h4>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">タスク *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="例: ○○さんに連絡する"
                           class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('title') border-red-500 @enderror">
                    @error('title')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">期限</label>
                        <input type="date" name="due_date" value="{{ old('due_date') }}"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('due_date') border-red-500 @enderror">
                        @error('due_date')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">紐付け先（案件）</label>
                        <select name="deal_id"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('deal_id') border-red-500 @enderror">
                            <option value="">選択しない</option>
                            @foreach($deals as $deal)
                                <option value="{{ $deal->id }}" {{ old('deal_id') == $deal->id ? 'selected' : '' }}>
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
                            <option value="{{ $card->id }}" {{ old('card_id') == $card->id ? 'selected' : '' }}>
                                {{ $card->full_name }} - {{ $card->company->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('card_id')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <!-- フッター -->
        <div class="flex items-center gap-3">
            <button type="submit" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                追加
            </button>
            <a href="{{ route('todos.index') }}" class="flex items-center gap-2 px-6 py-2 border border-gray-200 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 transition">
                キャンセル
            </a>
        </div>

        <!-- リダイレクト先 -->
        @if(request('redirect'))
            <input type="hidden" name="redirect" value="{{ request('redirect') }}">
        @endif
    </form>
</div>
@endsection
