
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeishiHub - @yield('title', '名刺管理')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="flex h-screen overflow-hidden">

        <aside class="w-56 bg-white border-r border-gray-100 flex flex-col flex-shrink-0">
            <div class="px-5 py-5 border-b border-gray-100">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    </div>
                    <div>
                        <div class="text-sm font-medium">MeishiHub</div>
                        <div class="text-xs text-gray-400">名刺管理システム</div>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-3 py-4 space-y-1">
                <p class="text-xs text-gray-400 px-2 mb-2 uppercase tracking-wider">メイン</p>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-800 font-medium' : 'text-gray-500 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                    ダッシュボード
                </a>
                <a href="{{ route('companies.create') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('companies.create') ? 'bg-emerald-50 text-emerald-800 font-medium' : 'text-gray-500 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                    名刺を登録
                </a>

                <p class="text-xs text-gray-400 px-2 mt-4 mb-2 uppercase tracking-wider">管理</p>
                <a href="{{ route('companies.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('companies.*') ? 'bg-emerald-50 text-emerald-800 font-medium' : 'text-gray-500 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10z"/></svg>
                    会社・名刺管理
                </a>
                <a href="{{ route('deals.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('deals.*') ? 'bg-emerald-50 text-emerald-800 font-medium' : 'text-gray-500 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/></svg>
                    案件管理
                </a>
                <a href="{{ route('todos.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('todos.*') ? 'bg-emerald-50 text-emerald-800 font-medium' : 'text-gray-500 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-9 14l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                    Todo
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white border-b border-gray-100 px-6 h-14 flex items-center gap-4 flex-shrink-0">
                <h1 class="text-sm font-medium flex-1">@yield('title', 'ダッシュボード')</h1>
                <a href="{{ route('companies.create') }}"
                   class="flex items-center gap-1 bg-emerald-500 text-white text-sm px-3 py-1.5 rounded-lg hover:bg-emerald-600 transition">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                    名刺を追加
                </a>
            </header>

            <main class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                    <div class="mb-4 bg-emerald-50 text-emerald-800 text-sm px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
