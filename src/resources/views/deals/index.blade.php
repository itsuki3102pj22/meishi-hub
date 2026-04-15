
@extends('layouts.app')
@section('title', '案件管理')

@section('content')
<div class="space-y-6">
    <!-- ページヘッダー -->
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-slate-900 mb-1">案件パイプライン</h3>
            <p class="text-sm text-slate-500">進捗中の案件一覧</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="px-4 py-2 bg-amber-50 text-amber-700 rounded-lg text-sm font-semibold">
                ¥{{ number_format($totalAmount) }}
            </span>
            <a href="{{ route('deals.create') }}"
               class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                案件を追加
            </a>
        </div>
    </div>

    <!-- パイプライン -->
    @php
    $statusColors = [
        'lead'        => 'bg-slate-50 border-slate-200',
        'proposal'    => 'bg-amber-50 border-amber-200',
        'negotiation' => 'bg-emerald-50 border-emerald-200',
        'won'         => 'bg-blue-50 border-blue-200',
    ];
    $badgeColors = [
        'lead'        => 'bg-slate-100 text-slate-700',
        'proposal'    => 'bg-amber-100 text-amber-700',
        'negotiation' => 'bg-emerald-100 text-emerald-700',
        'won'         => 'bg-blue-100 text-blue-700',
    ];
    @endphp

    <div class="grid grid-cols-4 gap-4">
        @foreach(['lead', 'proposal', 'negotiation', 'won'] as $status)
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="flex items-center justify-between">
                    <h4 class="text-sm font-bold text-slate-800">{{ $statuses[$status] }}</h4>
                    <span class="px-2 py-1 bg-slate-200 text-slate-700 rounded text-xs font-semibold">
                        {{ $grouped[$status]?->count() ?? 0 }}
                    </span>
                </div>
            </div>
            <div class="divide-y divide-gray-50 max-h-96 overflow-y-auto">
                @forelse($grouped[$status] ?? [] as $deal)
                <a href="{{ route('deals.show', $deal) }}"
                   class="block px-6 py-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between gap-2 mb-2">
                        <p class="text-sm font-semibold text-slate-800 flex-1">{{ $deal->name }}</p>
                        <span class="text-xs px-2 py-1 rounded font-semibold {{ $badgeColors[$deal->status] }} whitespace-nowrap flex-shrink-0">
                            {{ $deal->progress }}%
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 mb-2">{{ $deal->company->name }}</p>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-xs font-semibold text-slate-700">
                            {{ $deal->amount ? '¥' . number_format($deal->amount) : '金額未定' }}
                        </span>
                        @if($deal->close_date)
                        <span class="text-xs text-slate-400">{{ $deal->close_date->format('m/d') }}</span>
                        @endif
                    </div>
                </a>
                @empty
                <div class="px-6 py-8 text-center text-slate-400 text-xs">案件なし</div>
                @endforelse
            </div>
        </div>
        @endforeach
    </div>

    <!-- 失注 -->
    @if(($grouped['lost'] ?? collect())->count() > 0)
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h4 class="text-sm font-bold text-slate-800">失注（{{ $grouped['lost']->count() }}件）</h4>
        </div>
        <div class="divide-y divide-gray-50">
            @foreach($grouped['lost'] as $deal)
            <a href="{{ route('deals.show', $deal) }}"
               class="flex items-center gap-3 px-6 py-4 hover:bg-gray-50 transition-colors">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-600 line-through truncate">{{ $deal->name }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $deal->company->name }}</p>
                </div>
                <span class="text-sm font-semibold text-slate-400 flex-shrink-0">
                    {{ $deal->amount ? '¥' . number_format($deal->amount) : '' }}
                </span>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
