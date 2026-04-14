
@extends('layouts.app')
@section('title', $card->full_name)

@section('content')
<div class="space-y-6">
    <!-- ページヘッダー -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('companies.show', $card->company) }}" class="text-slate-400 hover:text-emerald-600 transition">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 12H5m7-7l-7 7 7 7"/></svg>
            </a>
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg">
                        {{ mb_substr($card->last_name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">{{ $card->full_name }}</h2>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $card->position }} @ {{ $card->company->name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('cards.edit', $card) }}"
               class="flex items-center gap-1 px-4 py-2 border border-gray-200 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z"/></svg>
                編集
            </a>
            <form action="{{ route('cards.destroy', $card) }}" method="POST"
                  onsubmit="return confirm('この名刺を削除しますか？')" class="inline">
                @csrf @method('DELETE')
                <button type="submit" class="flex items-center gap-1 px-4 py-2 border border-red-200 rounded-lg text-sm font-semibold text-red-600 hover:bg-red-50 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>
                    削除
                </button>
            </form>
        </div>
    </div>

    <!-- 統計情報 -->
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">メールアドレス</p>
            <h4 class="text-sm font-bold text-slate-900 truncate">{{ $card->email ?? '未登録' }}</h4>
            <p class="text-xs text-slate-400 mt-1">連絡先</p>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">電話番号</p>
            <h4 class="text-sm font-bold text-slate-900">{{ $card->phone ?? $card->mobile ?? '未登録' }}</h4>
            <p class="text-xs text-slate-400 mt-1">会社連絡先</p>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">登録日</p>
            <h4 class="text-sm font-bold text-slate-900">{{ $card->created_at->format('Y/m/d') }}</h4>
            <p class="text-xs text-slate-400 mt-1">{{ $card->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <!-- 会社・所属情報 -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100">
            <h4 class="text-sm font-bold text-slate-800">会社・所属情報</h4>
        </div>
        <div class="divide-y divide-gray-50">
            <div class="px-6 py-4">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">会社名</p>
                <a href="{{ route('companies.show', $card->company) }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                    {{ $card->company->name }}
                </a>
            </div>
            <div class="px-6 py-4">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">部署</p>
                <p class="text-sm text-slate-700">{{ $card->department ?? '未設定' }}</p>
            </div>
            <div class="px-6 py-4">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">役職</p>
                <p class="text-sm text-slate-700">{{ $card->position ?? '未設定' }}</p>
            </div>
            <div class="px-6 py-4">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">業種</p>
                <p class="text-sm text-slate-700">{{ $card->company->industry ?? '未設定' }}</p>
            </div>
        </div>
    </div>

    <!-- 次の連絡方法 -->
    @if($card->mobile || $card->fax)
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100">
            <h4 class="text-sm font-bold text-slate-800">その他の連絡先</h4>
        </div>
        <div class="divide-y divide-gray-50">
            @if($card->mobile)
            <div class="px-6 py-4">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">携帯電話</p>
                <p class="text-sm text-slate-700">{{ $card->mobile }}</p>
            </div>
            @endif
            @if($card->fax)
            <div class="px-6 py-4">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">FAX</p>
                <p class="text-sm text-slate-700">{{ $card->fax }}</p>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- メモ・備考 -->
    @if($card->memo)
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100">
            <h4 class="text-sm font-bold text-slate-800">メモ・備考</h4>
        </div>
        <div class="px-6 py-4">
            <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $card->memo }}</p>
        </div>
    </div>
    @endif

    <!-- 関連する案件 -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h4 class="text-sm font-bold text-slate-800">関連する案件（{{ $card->deals->count() }}件）</h4>
        </div>
        
        @if($card->deals->isEmpty())
            <div class="px-6 py-12 text-center">
                <svg class="w-12 h-12 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                <p class="text-slate-500 text-sm">この名刺に紐付いた案件はありません</p>
            </div>
        @else
            <div class="divide-y divide-gray-50">
                @foreach($card->deals as $deal)
                @php
                    $statusColors = [
                        'lead'        => 'bg-slate-100 text-slate-700',
                        'proposal'    => 'bg-amber-100 text-amber-700',
                        'negotiation' => 'bg-emerald-100 text-emerald-700',
                        'won'         => 'bg-blue-100 text-blue-700',
                        'lost'        => 'bg-red-100 text-red-700',
                    ];
                    $statusLabels = [
                        'lead' => 'リード',
                        'proposal' => '提案',
                        'negotiation' => '交渉中',
                        'won' => '受注',
                        'lost' => '失注',
                    ];
                @endphp
                <a href="{{ route('deals.show', $deal) }}" class="flex items-center gap-3 px-6 py-4 hover:bg-gray-50 transition-colors">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900">{{ $deal->name }}</p>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $deal->company->name }}</p>
                    </div>
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <span class="text-xs px-2 py-1 rounded font-semibold {{ $statusColors[$deal->status] ?? 'bg-slate-100' }}">
                            {{ $statusLabels[$deal->status] ?? $deal->status }}
                        </span>
                        <svg class="w-4 h-4 text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="px-6 py-3 border-t border-gray-100 bg-gray-50">
                <a href="{{ route('deals.index') }}" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700">全て表示 →</a>
            </div>
        @endif
    </div>
</div>
@endsection