<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 text-white transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shadow-xl flex flex-col">

        <!-- Logo -->
        <div class="flex items-center justify-center h-16 bg-gray-800 border-b border-gray-700 shadow-md shrink-0">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold tracking-wider uppercase text-white">
                ADMIN PANEL
            </a>
        </div>

        <!-- Menu Items -->
        <nav class="flex-1 px-4 space-y-2 overflow-y-auto py-6 custom-scrollbar">

            <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </x-sidebar-link>

            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Konten Utama</p>
            </div>

            <x-sidebar-link :href="route('admin.pages.index')" :active="request()->routeIs('admin.pages.*')">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9"></path></svg>
                Kelola Halaman
            </x-sidebar-link>

            <x-sidebar-link :href="route('admin.news.index')" :active="request()->routeIs('admin.news.*')">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                Kelola Berita
            </x-sidebar-link>

            <x-sidebar-link :href="route('admin.agendas.index')" :active="request()->routeIs('admin.agendas.*')">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Kelola Agenda
            </x-sidebar-link>

            <x-sidebar-link :href="route('admin.galleries.index')" :active="request()->routeIs('admin.galleries.*')">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Kelola Galeri
            </x-sidebar-link>

            <x-sidebar-link :href="route('admin.commissioners.index')" :active="request()->routeIs('admin.commissioners.*')">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Komisioner
            </x-sidebar-link>

            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Dokumen & File</p>
            </div>

            {{-- MENU DIPECAH (Menggunakan parameter di URL agar tetap pakai satu controller tapi seolah-olah beda menu) --}}

            {{-- 1. Laporan --}}
            <x-sidebar-link :href="route('admin.documents.index', ['type' => 'laporan'])" :active="request()->query('type') == 'laporan'">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Laporan
            </x-sidebar-link>

            {{-- 2. Regulasi --}}
            <x-sidebar-link :href="route('admin.documents.index', ['type' => 'regulasi'])" :active="request()->query('type') == 'regulasi'">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                Regulasi
            </x-sidebar-link>

            {{-- 3. Info Publik --}}
            <x-sidebar-link :href="route('admin.documents.index', ['type' => 'informasi-publik'])" :active="request()->query('type') == 'informasi-publik'">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Info Publik
            </x-sidebar-link>

            <div class="pt-8 pb-4 mt-auto">
                 <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-gray-300 hover:bg-red-600 hover:text-white rounded-md transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <!-- Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Header Atas (Putih) -->
        <header class="flex justify-between items-center py-4 px-6 bg-white border-b border-gray-200 shadow-sm shrink-0">
            <div class="flex items-center">
                {{-- Tombol Hamburger Mobile --}}
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden mr-4">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>

                {{-- Judul Halaman (Dinamis dari slot header) --}}
                <div class="text-xl font-semibold text-gray-800">
                    {{ $header ?? '' }}
                </div>
            </div>

            <div class="flex items-center">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none hover:bg-gray-100 rounded-full p-1 transition">
                        <div class="font-semibold text-gray-700 text-sm">{{ Auth::user()->name }}</div>
                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-50 border border-gray-100">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content (Slot) -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
            {{ $slot }}
        </main>
    </div>
</div>
