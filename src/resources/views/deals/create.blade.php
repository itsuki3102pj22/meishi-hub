
@extends('layouts.app')
@section('title', '案件を追加')

@section('content')
<div class="space-y-6">
    <!-- ページヘッダー -->
    <div class="flex items-center gap-4">
        <a href="{{ route('deals.index') }}" class="text-slate-400 hover:text-emerald-600 transition">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 12H5m7-7l-7 7 7 7"/></svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-slate-900">新規案件を追加</h2>
            <p class="text-sm text-slate-500 mt-0.5">新しい商談を登録します</p>
        </div>
    </div>

    <!-- フォーム -->
    <form action="{{ route('deals.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- 基本情報 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">基本情報</h4>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">案件名 *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('name') border-red-500 @enderror"
                           placeholder="例：ERPシステム導入">
                    @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">会社 *</label>
                        <select name="company_id" required
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('company_id') border-red-500 @enderror">
                            <option value="">選択してください</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('company_id')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">担当者</label>
                        <select name="card_id"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('card_id') border-red-500 @enderror">
                            <option value="">選択しない</option>
                            @foreach($cards as $card)
                                <option value="{{ $card->id }}" {{ old('card_id') == $card->id ? 'selected' : '' }}>
                                    {{ $card->full_name }} ({{ $card->company->name }})
                                </option>
                            @endforeach
                        </select>
                        @error('card_id')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- ステータス・スケジュール -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">ステータス・スケジュール</h4>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">ステータス *</label>
                        <select name="status" required
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('status') border-red-500 @enderror">
                            <option value="lead" {{ old('status') == 'lead' ? 'selected' : '' }}>リード</option>
                            <option value="proposal" {{ old('status') == 'proposal' ? 'selected' : '' }}>提案中</option>
                            <option value="negotiation" {{ old('status') == 'negotiation' ? 'selected' : '' }}>商談中</option>
                            <option value="won" {{ old('status') == 'won' ? 'selected' : '' }}>受注済み</option>
                            <option value="lost" {{ old('status') == 'lost' ? 'selected' : '' }}>失注</option>
                        </select>
                        @error('status')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">クローズ予定日</label>
                        <input type="date" name="close_date" value="{{ old('close_date') }}"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('close_date') border-red-500 @enderror">
                        @error('close_date')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- 金額・進捗 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">金額・進捗</h4>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">金額（円）</label>
                        <input type="number" name="amount" value="{{ old('amount') }}"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('amount') border-red-500 @enderror"
                               placeholder="1000000">
                        @error('amount')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">進捗（%）</label>
                        <input type="number" name="progress" value="{{ old('progress', 0) }}" min="0" max="100"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('progress') border-red-500 @enderror">
                        @error('progress')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- メモ -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">メモ・備考</h4>
            </div>
            <div class="p-6">
                <textarea name="memo" rows="5" placeholder="案件の詳細や経緯を記録..."
                          class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('memo') border-red-500 @enderror">{{ old('memo') }}</textarea>
                @error('memo')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- フッター -->
        <div class="flex items-center gap-3">
            <button type="submit" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                追加
            </button>
            <a href="{{ route('deals.index') }}" class="flex items-center gap-2 px-6 py-2 border border-gray-200 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 transition">
                キャンセル
            </a>
        </div>
    </form>
</div>
@endsection
