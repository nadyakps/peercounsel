
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'PeerCounsel')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F7F6FC] text-[#39344E]">

    @php
        $authUser = Auth::user();

        // Path ikon Heroicons outline
        $icons = [
            'home' => 'M2.25 12l8.954-8.955a1.126 1.126 0 011.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25',

            'plus' => 'M12 4.5v15m7.5-7.5h-15',

            'clock' => 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z',

            'inbox' => 'M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z',

            'users' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z',

            'logout' => 'M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9',
        ];

        // Menu berdasarkan role pengguna
if ($authUser->role === 'konseli') {

    $menuItems = [
        [
            'label' => 'Dashboard',
            'icon' => 'home',
            'href' => route('konseli.dashboard'),
            'active' => request()->routeIs('konseli.dashboard')
        ],
        [
            'label' => 'Mulai Konseling',
            'icon' => 'plus',
            'href' => route('konseli.counseling.index'),
            'active' => request()->routeIs(
                'konseli.counseling.index',
                'konseli.counseling.create'
            )
        ],
        [
            'label' => 'Riwayat Konseling',
            'icon' => 'clock',
            'href' => route('konseli.counseling.history'),
            'active' => request()->routeIs('konseli.counseling.history')
        ],
    ];

} elseif ($authUser->role === 'konselor') {

    $menuItems = [
        [
            'label' => 'Dashboard',
            'icon' => 'home',
            'href' => route('konselor.dashboard'),
            'active' => request()->routeIs('konselor.dashboard')
        ],
        [
            'label' => 'Permintaan Konseling',
            'icon' => 'inbox',
            'href' => route('konselor.counseling.index'),
            'active' => request()->routeIs(
                'konselor.counseling.index',
                'konselor.counseling.show',
                'konselor.counseling.accept',
                'konselor.counseling.reject'
            )
        ],
        [
            'label' => 'Riwayat Konseling',
            'icon' => 'clock',
            'href' => route('konselor.counseling.history'),
            'active' => request()->routeIs('konselor.counseling.history')
        ],
    ];

} else {

    // Menu admin akan ditambahkan setelah route admin tersedia.
    $menuItems = [];

}
    @endphp

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="w-64 shrink-0 bg-white border-r border-[#ECE9F5] px-5 py-7 flex flex-col">

            {{-- LOGO --}}
            <div class="mb-10 px-2">
                <h1 class="text-2xl font-extrabold tracking-tight text-[#6B5BC7]">
                    PeerCounsel<span class="text-[#A99CEB]">.</span>
                </h1>

                <p class="text-xs text-[#A09CAF] mt-1">
                    Peer Counseling Platform
                </p>
            </div>

            {{-- LABEL MENU --}}
            <p class="text-[11px] font-bold text-[#AAA5B8] uppercase tracking-wider px-3 mb-3">
                Menu Utama
            </p>

            {{-- NAVIGASI --}}
            <nav class="space-y-1.5">

                @foreach ($menuItems as $item)

                    <a href="{{ $item['href'] }}"
                       @if ($item['active']) aria-current="page" @endif
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition
                              {{ $item['active']
                                    ? 'bg-[#F0EDFF] text-[#6B5BC7] font-semibold'
                                    : 'text-[#777387] hover:bg-[#F8F7FC] hover:text-[#39344E]' }}">

                        <svg class="h-5 w-5 shrink-0"
                             xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.6"
                             stroke="currentColor"
                             aria-hidden="true">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="{{ $icons[$item['icon']] }}" />

                        </svg>

                        <span>{{ $item['label'] }}</span>

                    </a>

                @endforeach

            </nav>

            {{-- INFORMASI AKUN --}}
            <div class="mt-auto pt-6 border-t border-[#ECE9F5]">

                <div class="flex items-center gap-3 px-2 mb-4">

                    <div class="w-10 h-10 shrink-0 rounded-full bg-[#F0EDFF] flex items-center justify-center text-[#6B5BC7] font-bold text-sm">
                        {{ strtoupper(substr($authUser->name, 0, 1)) }}
                    </div>

                    <div class="min-w-0">

                        <p class="font-semibold text-sm text-[#39344E] truncate">
                            {{ $authUser->name }}
                        </p>

                        <p class="text-xs text-[#A09CAF] capitalize mt-0.5">
                            {{ $authUser->role }}
                        </p>

                    </div>

                </div>

                {{-- LOGOUT --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-[#D65A68] hover:bg-[#FFF1F2] transition">

                        <svg class="h-5 w-5 shrink-0"
                             xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.6"
                             stroke="currentColor"
                             aria-hidden="true">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="{{ $icons['logout'] }}" />

                        </svg>

                        <span>Logout</span>

                    </button>
                </form>

            </div>

        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 min-w-0">

            {{-- HEADER --}}
            <header class="min-h-20 bg-white border-b border-[#ECE9F5] flex items-center justify-between px-8 py-4">

                <div>
                    <h2 class="text-lg font-bold text-[#39344E]">
                        @yield('page-heading', 'Dashboard')
                    </h2>

                    <p class="text-xs text-[#A09CAF] mt-1">
                        Welcome to PeerCounsel
                    </p>
                </div>

                <div class="text-sm text-[#89869A]">
                    Peer Counseling Platform
                </div>

            </header>

            {{-- PAGE CONTENT --}}
            <section class="p-8">
                @yield('content')
            </section>

        </main>

    </div>

</body>
</html>
