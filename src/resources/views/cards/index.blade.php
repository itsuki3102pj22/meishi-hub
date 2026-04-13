@extends('layouts.app')
@section('title', '名刺管理')

@section('content')
<div class="space-y-6">
    <!-- ページヘッダー -->
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-slate-900 mb-1">全名刺</h3>
            <p class="text-sm text-slate-500">登録されている全ての名刺</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="px-4 py-2 bg-emerald-50 text-emerald-700 rounded-lg text-sm font-semibold">
                {{ $cards->count() }}枚
            </span>
            <a href="{{ route('companies.create') }}"
               class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                名刺を追加
            </a>
        </div>
    </div>

    <!-- 名刺グリッド -->
    @if($cards->isEmpty())
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 px-6 py-12 text-center">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4"></path></svg>
            <p class="text-slate-500 text-sm mb-4">登録された名刺がありません</p>
            <a href="{{ route('companies.create') }}"
               class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                最初の名刺を追加
            </a>
        </div>
    @else
        <div class="grid grid-cols-4 gap-4">
            @foreach($cards as $card)
            <a href="{{ route('cards.show', $card) }}"
               class="bg-white rounded-lg p-4 shadow-sm border border-gray-100 hover:shadow-md hover:border-emerald-200 transition-all group">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm group-hover:bg-emerald-100 transition">
                        {{ mb_substr($card->last_name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900 truncate">{{ $card->full_name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ $card->position }}</p>
                    </div>
                </div>
                <div class="space-y-1">
                    <p class="text-xs text-slate-600 truncate">
                        <span class="font-semibold">会社:</span> {{ $card->company->name }}
                    </p>
                    <p class="text-xs text-slate-500">{{ $card->email }}</p>
                </div>
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
                    <span class="text-xs text-slate-400">{{ $card->created_at->diffForHumans() }}</span>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-emerald-600 transition" fill="currentColor" viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                </div>
            </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
