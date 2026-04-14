@extends('layouts.app')
@section('title', '会社・名刺管理')

@section('content')
<div class="space-y-6">
    <!-- ページヘッダー -->
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-slate-900 mb-1">会社・名刺管理</h3>
            <p class="text-sm text-slate-500">{{ $companies->count() }}社登録済み</p>
        </div>
        <a href="{{ route('companies.create') }}"
           class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
            会社を追加
        </a>
    </div>

    <!-- 会社カード一覧 -->
    <div class="grid grid-cols-4 gap-4">
        @forelse($companies as $company)
        <a href="{{ route('companies.show', $company) }}"
           class="bg-white rounded-lg p-5 shadow-sm border border-gray-100 hover:shadow-md hover:border-emerald-300 transition-all block">
            <div class="flex items-start justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg">
                    {{ mb_substr($company->name, 0, 1) }}
                </div>
                <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded">{{ $company->cards_count }}</span>
            </div>
            <h4 class="text-sm font-bold text-slate-900 mb-1 line-clamp-2">{{ $company->name }}</h4>
            <p class="text-xs text-slate-500 mb-3">{{ $company->industry ?? '業種未設定' }}</p>
            <div class="flex items-center justify-between text-xs">
                <span class="text-slate-400">名刺</span>
                <span class="font-semibold text-slate-700">{{ $company->cards_count }}枚</span>
            </div>
            <div class="flex items-center justify-between text-xs mt-2 pt-2 border-t border-gray-100">
                <span class="text-slate-400">案件</span>
                <span class="font-semibold text-slate-700">{{ $company->deals_count }}件</span>
            </div>
        </a>
        @empty
        <div class="col-span-4 text-center py-16">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5.5m0 0h-5m5 0v-3a1.5 1.5 0 00-3 0v3m0 0H6.5"></path></svg>
            <p class="text-slate-500 text-sm mb-4">会社がまだ登録されていません</p>
            <a href="{{ route('companies.create') }}"
               class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                最初の会社を追加
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection