@extends('layouts.app')
@section('title', '名刺を追加')

@section('content')
<div class="space-y-6">
    <!-- ページヘッダー -->
    <div class="flex items-center gap-4">
        <a href="{{ route('cards.index') }}" class="text-slate-400 hover:text-emerald-600 transition">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 12H5m7-7l-7 7 7 7"/></svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-slate-900">新規名刺を追加</h2>
            <p class="text-sm text-slate-500 mt-0.5">新しい名刺情報を登録します</p>
        </div>
    </div>

    <!-- フォーム -->
    <form action="{{ route('cards.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- 基本情報 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">基本情報</h4>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">苗字 *</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" required
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('last_name') border-red-500 @enderror">
                        @error('last_name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">名前 *</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" required
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('first_name') border-red-500 @enderror">
                        @error('first_name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">メールアドレス</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('email') border-red-500 @enderror">
                        @error('email')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">会社 *</label>
                        <select name="company_id" required
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('company_id') border-red-500 @enderror">
                            <option value="">選択してください</option>
                            @foreach(\App\Models\Company::orderBy('name')->get() as $company)
                                <option value="{{ $company->id }}" {{ old('company_id') === (string)$company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('company_id')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- 所属情報 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h4 class="text-sm font-bold text-slate-800">所属情報</h4>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">部署</label>
                        <input type="text" name="department" value="{{ old('department') }}"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('department') border-red-500 @enderror">
                        @error('department')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">役職</label>
                        <input type="text" name="position" value="{{ old('position') }}"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('position') border-red-500 @enderror">
                        @error('position')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
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
                        <input type="tel" name="phone" value="{{ old('phone') }}"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('phone') border-red-500 @enderror">
                        @error('phone')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">携帯電話</label>
                        <input type="tel" name="mobile" value="{{ old('mobile') }}"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('mobile') border-red-500 @enderror">
                        @error('mobile')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">FAX</label>
                    <input type="tel" name="fax" value="{{ old('fax') }}"
                           class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('fax') border-red-500 @enderror">
                    @error('fax')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
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
            <a href="{{ route('cards.index') }}" class="flex items-center gap-2 px-6 py-2 border border-gray-200 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 transition">
                キャンセル
            </a>
        </div>
    </form>
</div>
@endsection
