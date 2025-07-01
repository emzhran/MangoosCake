<!-- Sidebar -->
<aside class="w-64 flex-shrink-0 bg-white shadow-lg flex flex-col">
    <!-- Logo -->
    <div class="h-20 flex items-center justify-center border-b border-orange-100">
        <h1 class="text-3xl font-pacifico text-yellow-500">Mangoo's</h1>
    </div>

    <!-- Menu Navigasi -->
    <nav class="flex-grow px-4 py-6">
        <ul class="space-y-3">
            {{-- Item Menu: Dashboard --}}
            <li>
                {{-- Gunakan helper route() untuk link dan cek route aktif dengan routeIs() --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link flex items-center px-4 py-3 rounded-lg hover:bg-yellow-400 hover:text-white
                          {{ request()->routeIs('admin.dashboard') ? 'bg-yellow-500 text-white font-semibold' : 'text-gray-700' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span>Dashboard</span>
                </a>
            </li>
            {{-- Item Menu: Data Kue --}}
            <li>
                <a href="{{ route('admin.datakue.index') }}"
                   class="nav-link flex items-center px-4 py-3 rounded-lg hover:bg-yellow-400 hover:text-white
                          {{ request()->routeIs('admin.datakue') ? 'bg-yellow-500 text-white font-semibold' : 'text-gray-700' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0c-.454-.303-.977-.454-1.5-.454V5.118a2.5 2.5 0 012.5-2.5h10a2.5 2.5 0 012.5 2.5v10.428zM5.121 14.121A2.5 2.5 0 017.5 13h9a2.5 2.5 0 012.379 1.121M9 10a1 1 0 11-2 0 1 1 0 012 0zm6 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                    <span>Data Kue</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.data-pemesanan.index') }}"
                   class="nav-link flex items-center px-4 py-3 rounded-lg hover:bg-yellow-400 hover:text-white
                          {{ request()->routeIs('admin.data-pemesanan.*') ? 'bg-yellow-500 text-white font-semibold' : 'text-gray-700' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0c-.454-.303-.977-.454-1.5-.454V5.118a2.5 2.5 0 012.5-2.5h10a2.5 2.5 0 012.5 2.5v10.428zM5.121 14.121A2.5 2.5 0 017.5 13h9a2.5 2.5 0 012.379 1.121M9 10a1 1 0 11-2 0 1 1 0 012 0zm6 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                    <span>Data Pesanan</span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="px-4 pb-4">
    <form action="{{ route('logout') }}" method="POST" class="w-full">
        <button type="submit" class="flex items-center justify-center w-full px-4 py-3 text-white bg-yellow-500 rounded-lg hover:bg-yellow-600">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H3"></path></svg>
            <span>Logout</span>
        </button>
    </form>
</div>
</aside>
