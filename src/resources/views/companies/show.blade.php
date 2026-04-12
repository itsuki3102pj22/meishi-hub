@extends('layouts.app')
@section('title', $company->name)

@section('content')
<div class="space-y-6">
    <!-- ページヘッダー -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('companies.index') }}" class="text-slate-400 hover:text-emerald-600 transition">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 12H5m7-7l-7 7 7 7"/></svg>
            </a>
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg">
                        {{ mb_substr($company->name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">{{ $company->name }}</h2>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $company->industry ?? '業種未設定' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('deals.index') }}?company={{ $company->id }}"
               class="flex items-center gap-1 px-4 py-2 border border-gray-200 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/></svg>
                案件を見る
            </a>
            <a href="{{ route('companies.cards.create', $company) }}"
               class="flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                名刺を追加
            </a>
        </div>
    </div>

    <!-- 統計情報 -->
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">登録名刺</p>
            <h4 class="text-2xl font-bold text-slate-900">{{ $company->cards->count() }}</h4>
            <p class="text-xs text-slate-400 mt-1">人の名刺</p>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">関連案件</p>
            <h4 class="text-2xl font-bold text-slate-900">{{ $company->deals->count() }}</h4>
            <p class="text-xs text-slate-400 mt-1">件の案件</p>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">登録日</p>
            <h4 class="text-lg font-bold text-slate-900">{{ $company->created_at->format('Y/m/d') }}</h4>
            <p class="text-xs text-slate-400 mt-1">{{ $company->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <!-- 登録名刺 -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h4 class="text-sm font-bold text-slate-800">登録名刺（{{ $company->cards->count() }}枚）</h4>
        </div>
        
        @if($company->cards->isEmpty())
            <div class="px-6 py-12 text-center">
                <svg class="w-12 h-12 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4"></path></svg>
                <p class="text-slate-500 text-sm mb-4">この会社の名刺がまだ登録されていません</p>
                <a href="{{ route('companies.cards.create', $company) }}"
                   class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                    最初の名刺を追加
                </a>
            </div>
        @else
            <div class="divide-y divide-gray-50">
                @foreach($company->cards as $card)
                <a href="{{ route('cards.show', $card) }}"
                   class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-sm flex-shrink-0">
                        {{ mb_substr($card->last_name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900">{{ $card->full_name }}</p>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $card->position }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $card->email }}</p>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                </a>
                @endforeach
            </div>
            <div class="px-6 py-3 border-t border-gray-100 bg-gray-50">
                <a href="{{ route('companies.cards.create', $company) }}" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700">名刺を追加 →</a>
            </div>
        @endif
    </div>
</div>
@endsection
