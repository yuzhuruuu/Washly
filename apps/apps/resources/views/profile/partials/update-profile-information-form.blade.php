<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Profil Pelanggan') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui informasi profil dan alamat email akun Washly Anda.") }}
        </p>
    </header>

    {{-- Form verifikasi dihapus karena menyebabkan error Route Not Found --}}

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Input Nama --}}
        <div>
            <x-input-label for="nama" :value="__('Nama Lengkap')" />
            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $user->nama)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
        </div>

        {{-- Input Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        {{-- Input No HP --}}
        <div>
            <x-input-label for="no_hp" :value="__('Nomor WhatsApp')" />
            <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" :value="old('no_hp', $user->no_hp)" required />
            <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
        </div>

        {{-- Input Alamat --}}
        <div>
            <x-input-label for="alamat" :value="__('Alamat Penjemputan')" />
            <textarea id="alamat" name="alamat" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('alamat', $user->alamat) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Berhasil disimpan.') }}</p>
            @endif
        </div>
    </form>
</section>