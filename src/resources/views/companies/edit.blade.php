@extends('layouts.app')
@section('title', $company->name . ' - 編集')

@section('content')
<div class="space-y-6">
    <!-- ページヘッダー -->
    <div class="flex items-center gap-4">
        <a href="{{ route('companies.show', $company) }}" class="text-slate-400 hover:text-emerald-600 transition">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 12H5m7-7l-7 7 7 7"/></svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-slate-900">会社を編集</h2>
            <p class="text-sm text-slate-500 mt-0.5">{{ $company->name }}</p>
        </div>
    </div>

    <!-- フォーム -->
    <form action="{{ route('companies.update', $company) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- 基本情報 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">基本情報</h4>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">会社名 *</label>
                    <input type="text" name="name" value="{{ $company->name }}" required
                           class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('name') border-red-500 @enderror">
                    @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">会社名（カナ）</label>
                        <input type="text" name="name_kana" value="{{ $company->name_kana }}"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('name_kana') border-red-500 @enderror">
                        @error('name_kana')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">業種</label>
                        <input type="text" name="industry" value="{{ $company->industry }}"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('industry') border-red-500 @enderror">
                        @error('industry')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- 連絡先情報 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">連絡先情報</h4>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">電話番号</label>
                        <input type="tel" name="phone" value="{{ $company->phone }}"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('phone') border-red-500 @enderror">
                        @error('phone')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">ウェブサイト</label>
                        <input type="url" name="website" value="{{ $company->website }}"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('website') border-red-500 @enderror">
                        @error('website')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- 住所 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">住所</h4>
            </div>
            <div class="p-6">
                <textarea name="address" rows="3"
                          class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('address') border-red-500 @enderror">{{ $company->address }}</textarea>
                @error('address')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- メモ -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">メモ・備考</h4>
            </div>
            <div class="p-6">
                <textarea name="memo" rows="5"
                          class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('memo') border-red-500 @enderror">{{ $company->memo }}</textarea>
                @error('memo')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- フッター -->
        <div class="flex items-center gap-3">
            <button type="submit" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/></svg>
                保存
            </button>
            <a href="{{ route('companies.show', $company) }}" class="flex items-center gap-2 px-6 py-2 border border-gray-200 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 transition">
                キャンセル
            </a>
        </div>
    </form>
</div>
@endsection
