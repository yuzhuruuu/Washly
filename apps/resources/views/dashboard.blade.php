@php
    // Cek siapa yang login dan arahkan langsung ke halaman dashboard-nya
    if(Auth::guard('admin')->check()) {
        $dashboardView = 'admin.dashboard';
    } elseif(Auth::guard('kurir')->check()) {
        $dashboardView = 'kurir.dashboard';
    } else {
        $dashboardView = 'pelanggan.dashboard';
    }
@endphp

{{-- Langsung include view yang bener tanpa pakai container layout duplikat --}}
@include($dashboardView)