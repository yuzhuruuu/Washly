<nav x-data="{ mobileMenuOpen: false }" class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between py-4 gap-4">
            <div class="flex items-center gap-3">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-200 text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition">
                    <i class="fas fa-bars text-lg"></i>
                </button>
                <a href="{{ route('pelanggan.dashboard') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/w-g.svg') }}" alt="Washly" class="h-8">
                </a>
            </div>

            <div class="hidden md:flex flex-1 justify-center space-x-6 text-sm font-semibold">
                <a href="{{ route('pelanggan.dashboard') }}" class="{{ request()->routeIs('pelanggan.dashboard') ? 'text-[#0074A6] border-b-2 border-[#0074A6] pb-1' : 'text-gray-400 hover:text-gray-600 transition' }}">Beranda</a>
                <a href="{{ route('pelanggan.pesanan.baru') }}" class="{{ request()->routeIs('pelanggan.pesanan.baru') ? 'text-[#0074A6] border-b-2 border-[#0074A6] pb-1' : 'text-gray-400 hover:text-gray-600 transition' }}">Layanan</a>
                <a href="{{ route('pelanggan.riwayat') }}" class="{{ request()->routeIs('pelanggan.riwayat') ? 'text-[#0074A6] border-b-2 border-[#0074A6] pb-1' : 'text-gray-400 hover:text-gray-600 transition' }}">Riwayat</a>
                <a href="{{ route('pelanggan.tentang-kami') }}" class="{{ request()->routeIs('pelanggan.tentang-kami') ? 'text-[#0074A6] border-b-2 border-[#0074A6] pb-1' : 'text-gray-400 hover:text-gray-600 transition' }}">Tentang Kami</a>
            </div>

            <div class="flex items-center gap-3">
                <span class="hidden lg:inline text-sm text-gray-500 font-medium">Halo, {{ Auth::guard('pelanggan')->user()?->nama ?? 'Pelanggan' }}!</span>
                <a href="{{ route('pelanggan.bantuan') }}" class="hidden sm:inline text-gray-400 hover:text-[#0074A6] transition"><i class="far fa-question-circle text-lg"></i></a>
                <a href="{{ route('pelanggan.profil') }}" class="w-8 h-8 rounded-full bg-blue-50 overflow-hidden border border-blue-200 block hover:ring-2 hover:ring-[#00AEEF] hover:shadow-md transition-all">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('pelanggan')->user()?->nama ?? 'User') }}&background=0074A6&color=fff&bold=true" alt="Avatar" class="w-full h-full object-cover">
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-red-600 text-xs font-bold pl-2 border-l border-gray-200 transition">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen" x-cloak @click.outside="mobileMenuOpen = false" x-transition class="md:hidden border-t border-gray-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 space-y-2">
            <a href="{{ route('pelanggan.dashboard') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">Dashboard</a>
            <a href="{{ route('pelanggan.pesanan.baru') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">Pesanan Baru</a>
            <a href="{{ route('pelanggan.riwayat') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">Riwayat</a>
            <a href="{{ route('pelanggan.profil') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">Profil</a>
            <a href="{{ route('pelanggan.bantuan') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">Bantuan</a>
            <a href="{{ route('pelanggan.tentang-kami') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">Tentang Kami</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left block rounded-xl px-4 py-3 text-sm font-semibold text-red-600 hover:bg-red-50">Keluar</button>
            </form>
        </div>
    </div>
</nav>
