@extends('layouts.app')
@section('title', 'ダッシュボード')

@section('content')
<div class="space-y-8">
    <!-- ページヘッダー -->
    <div>
        <h3 class="text-2xl font-bold text-slate-900 mb-1">本日のデータ</h3>
        <p class="text-sm text-slate-500">ビジネス管理システムの概況</p>
    </div>

    <!-- KPI Grid - 4列で1段表示 -->
    <div class="grid grid-cols-4 gap-4">
        <!-- 総名刺数 -->
        <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                </div>
            </div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">総名刺数</p>
            <div class="flex items-baseline gap-1">
                <h4 class="text-2xl font-bold text-slate-900">{{ number_format($stats['cards']) }}</h4>
                <span class="text-xs text-slate-500">枚</span>
            </div>
        </div>

        <!-- 取引会社数 -->
        <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                </div>
            </div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">取引会社数</p>
            <div class="flex items-baseline gap-1">
                <h4 class="text-2xl font-bold text-slate-900">{{ number_format($stats['companies']) }}</h4>
                <span class="text-xs text-slate-500">社</span>
            </div>
        </div>

        <!-- 進行案件 -->
        <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                </div>
            </div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">進行案件</p>
            <div class="flex items-baseline gap-1">
                <h4 class="text-2xl font-bold text-slate-900">{{ $stats['deals'] }}</h4>
                <span class="text-xs text-slate-500">件</span>
            </div>
        </div>

        <!-- 売上見込み -->
        <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-slate-900 text-white flex items-center justify-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                </div>
            </div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">売上見込み</p>
            <div class="flex items-baseline gap-1">
                <h4 class="text-xl font-bold text-slate-900">¥{{ number_format($stats['amount']) }}</h4>
            </div>
        </div>
    </div>

    <!-- 2段レイアウト：最近の名刺 と 案件 -->
    <div class="grid grid-cols-2 gap-8">
        <!-- 最近の登録名刺 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">最新の登録名刺</h4>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($recentCards as $card)
                <a href="{{ route('cards.show', $card) }}" class="flex items-center gap-3 px-6 py-3 hover:bg-gray-50 transition-colors">
                    <div class="w-9 h-9 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs flex-shrink-0">
                        {{ mb_substr($card->last_name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-800 truncate">{{ $card->full_name }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ $card->company->name }} / {{ $card->position }}</p>
                    </div>
                    <span class="text-[10px] text-slate-400 whitespace-nowrap">{{ $card->created_at->diffForHumans() }}</span>
                </a>
                @empty
                <div class="px-6 py-8 text-center text-slate-400 text-sm">登録データがありません</div>
                @endforelse
            </div>
            <div class="px-6 py-3 border-t border-gray-100 bg-gray-50">
                <a href="{{ route('cards.index') }}" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700">全て表示 →</a>
            </div>
        </div>

        <!-- 案件パイプライン -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">案件パイプライン</h4>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50/50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase">案件</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-slate-600 uppercase">フェーズ</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-slate-600 uppercase">金額</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentDeals as $deal)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3">
                                <a href="{{ route('deals.show', $deal) }}" class="text-slate-800 font-semibold hover:text-emerald-600">{{ $deal->name }}</a>
                                <p class="text-xs text-slate-400">{{ $deal->company->name }}</p>
                            </td>
                            <td class="px-6 py-3 text-center">
                                @php
                                $statusColors = [
                                    'lead' => 'bg-slate-100 text-slate-600',
                                    'proposal' => 'bg-amber-100 text-amber-700',
                                    'negotiation' => 'bg-emerald-100 text-emerald-700',
                                    'won' => 'bg-blue-100 text-blue-700',
                                    'lost' => 'bg-red-100 text-red-700',
                                ];
                                $statusLabels = [
                                    'lead' => 'リード',
                                    'proposal' => '提案',
                                    'negotiation' => '交渉中',
                                    'won' => '受注',
                                    'lost' => '失注',
                                ];
                                @endphp
                                <span class="px-2 py-1 rounded text-[10px] font-bold {{ $statusColors[$deal->status] ?? 'bg-slate-100' }}">
                                    {{ $statusLabels[$deal->status] ?? $deal->status }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-right font-semibold text-slate-700">¥{{ number_format($deal->amount) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-slate-400 text-sm">進行中の案件はありません</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-3 border-t border-gray-100 bg-gray-50">
                <a href="{{ route('deals.index') }}" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700">全て表示 →</a>
            </div>
        </div>
    </div>

    <!-- タスク（TODO）セクション -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h4 class="text-sm font-bold text-slate-800">未完了のタスク</h4>
            <a href="{{ route('todos.create') }}" class="flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                追加
            </a>
        </div>
        
        @forelse($todos as $todo)
        <div class="flex items-center gap-4 px-6 py-4 border-b border-gray-50 last:border-b-0 hover:bg-gray-50 transition-colors group">
            <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="flex-shrink-0">
                @csrf @method('PATCH')
                <button type="submit" class="w-5 h-5 rounded border-2 border-slate-300 flex items-center justify-center hover:border-emerald-500 transition group-hover:border-emerald-500 bg-white">
                    <span class="material-symbols-outlined text-emerald-600 text-xs opacity-0 group-hover:opacity-100 transition-opacity">check</span>
                </button>
            </form>
            <div class="flex-1">
                <h6 class="text-sm font-semibold text-slate-800">{{ $todo->title }}</h6>
                @if($todo->due_date)
                <div class="flex items-center gap-1 mt-1 text-slate-400">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                    <span class="text-[10px]">{{ $todo->due_date->format('Y/m/d') }}</span>
                </div>
                @endif
            </div>
            <a href="{{ route('todos.show', $todo) }}" class="flex-shrink-0 text-slate-300 hover:text-slate-600 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z"/></svg>
            </a>
        </div>
        @empty
        <div class="px-6 py-12 text-center">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-slate-400 text-sm">すべてのタスクが完了しています！</p>
        </div>
        @endforelse
    </div>
</div>
@endsection