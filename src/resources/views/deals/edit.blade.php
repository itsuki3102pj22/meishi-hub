
@extends('layouts.app')
@section('title', $deal->name . ' - 編集')

@section('content')
<div class="space-y-6">
    <!-- ページヘッダー -->
    <div class="flex items-center gap-4">
        <a href="{{ route('deals.show', $deal) }}" class="text-slate-400 hover:text-emerald-600 transition">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 12H5m7-7l-7 7 7 7"/></svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-slate-900">案件を編集</h2>
            <p class="text-sm text-slate-500 mt-0.5">{{ $deal->name }}</p>
        </div>
    </div>

    <!-- フォーム -->
    <form action="{{ route('deals.update', $deal) }}" method="POST" class="space-y-6">
        @csrf @method('PUT')

        <!-- 基本情報 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">基本情報</h4>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">案件名 *</label>
                    <input type="text" name="name" value="{{ old('name', $deal->name) }}" required
                           class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('name') border-red-500 @enderror">
                    @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">会社 *</label>
                        <select name="company_id" required
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('company_id') border-red-500 @enderror">
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id', $deal->company_id) == $company->id ? 'selected' : '' }}>
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
                                <option value="{{ $card->id }}" {{ old('card_id', $deal->card_id) == $card->id ? 'selected' : '' }}>
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
                            @foreach(['lead' => 'リード', 'proposal' => '提案中', 'negotiation' => '商談中', 'won' => '受注済み', 'lost' => '失注'] as $value => $label)
                                <option value="{{ $value }}" {{ old('status', $deal->status) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">クローズ予定日</label>
                        <input type="date" name="close_date" value="{{ old('close_date', $deal->close_date?->format('Y-m-d')) }}"
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
                        <input type="number" name="amount" value="{{ old('amount', $deal->amount) }}"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('amount') border-red-500 @enderror">
                        @error('amount')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">進捗（%）</label>
                        <input type="number" name="progress" value="{{ old('progress', $deal->progress) }}" min="0" max="100"
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
                <textarea name="memo" rows="5"
                          class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('memo') border-red-500 @enderror">{{ old('memo', $deal->memo) }}</textarea>
                @error('memo')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- フッター -->
        <div class="flex items-center gap-3">
            <button type="submit" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/></svg>
                保存
            </button>
            <a href="{{ route('deals.show', $deal) }}" class="flex items-center gap-2 px-6 py-2 border border-gray-200 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 transition">
                キャンセル
            </a>
        </div>
    </form>
</div>
@endsection
