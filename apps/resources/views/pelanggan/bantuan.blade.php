<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bantuan & FAQ - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased selection:bg-[#00AEEF] selection:text-white">

    @include('pelanggan.partials.navbar')

    {{-- HEADER BANTUAN (Gradasi Soft & Ruang Napas Lega!) --}}
    <header class="text-white relative overflow-hidden" style="background: linear-gradient(135deg, #0074A6 0%, #38bdf8 100%); padding-top: 100px; padding-bottom: 120px;">
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-white opacity-10 rounded-full blur-2xl"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-white opacity-10 rounded-full blur-2xl"></div>
        
        <div class="max-w-3xl mx-auto px-8 relative z-10 text-center">
            <h1 class="text-4xl font-black mb-4">Halo, ada yang bisa kami bantu?</h1>
            <p class="text-blue-100 font-medium text-lg mb-10">Temukan jawaban dari pertanyaan yang paling sering diajukan oleh pelanggan Washly di bawah ini.</p>
            
            <div class="max-w-3xl mx-auto mt-6 px-4 sm:px-0">
                <div class="flex items-center bg-white rounded-full shadow-lg w-full overflow-hidden transition" style="border: 2px solid transparent;">
                    <div class="flex items-center justify-center pointer-events-none" style="padding-left: 24px; padding-right: 12px;">
                        <i class="fas fa-search text-gray-400 text-lg"></i>
                    </div>
                    <input type="text" id="searchInput" placeholder="Ketik kata kunci (misal: pembayaran, hilang...)" class="w-full text-gray-800 bg-transparent" style="padding: 18px 24px 18px 0; border: none; outline: none; box-shadow: none;">
                </div>
            </div>
        </div>
    </header>

    {{-- KONTEN FAQ (Udah dikasih margin-top biar nggak nabrak header) --}}
    <main class="max-w-5xl lg:max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20" style="margin-top: 80px; padding-bottom: 100px;">
        <div class="space-y-4" id="faqContainer">
            
            <!-- FAQ 1 (Tambahin class 'faq-item') -->
            <details class="faq-item group bg-white rounded-2xl shadow-sm border border-gray-100 p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                <summary class="flex justify-between items-center font-bold text-gray-800 outline-none">
                    <span class="text-lg">Bagaimana cara memesan layanan laundry di Washly?</span>
                    <span class="transition-transform duration-300 group-open:rotate-180 shrink-0 text-[#0074A6] bg-blue-50 w-8 h-8 flex items-center justify-center rounded-full ml-4">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </summary>
                <div class="text-gray-500 mt-4 leading-relaxed font-medium pt-4 border-t border-gray-50">
                    Sangat mudah! Buka menu <strong>Layanan</strong>, pilih jenis layanan yang kamu inginkan (misal: Cuci Komplit atau Setrika Saja), masukkan alamat penjemputan, dan klik pesan. Kurir kami akan segera meluncur ke lokasimu!
                </div>
            </details>

            <!-- FAQ 2 -->
            <details class="faq-item group bg-white rounded-2xl shadow-sm border border-gray-100 p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                <summary class="flex justify-between items-center font-bold text-gray-800 outline-none">
                    <span class="text-lg">Apakah saya perlu menimbang cucian sendiri?</span>
                    <span class="transition-transform duration-300 group-open:rotate-180 shrink-0 text-[#0074A6] bg-blue-50 w-8 h-8 flex items-center justify-center rounded-full ml-4">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </summary>
                <div class="text-gray-500 mt-4 leading-relaxed font-medium pt-4 border-t border-gray-50">
                    Tidak perlu repot! Kamu cukup kumpulkan pakaian kotormu. Kurir Washly akan menimbangnya secara langsung di tempatmu menggunakan timbangan digital presisi, dan total tagihan akan otomatis muncul di aplikasimu.
                </div>
            </details>

            <!-- FAQ 3 -->
            <details class="faq-item group bg-white rounded-2xl shadow-sm border border-gray-100 p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                <summary class="flex justify-between items-center font-bold text-gray-800 outline-none">
                    <span class="text-lg">Kapan dan bagaimana saya melakukan pembayaran?</span>
                    <span class="transition-transform duration-300 group-open:rotate-180 shrink-0 text-[#0074A6] bg-blue-50 w-8 h-8 flex items-center justify-center rounded-full ml-4">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </summary>
                <div class="text-gray-500 mt-4 leading-relaxed font-medium pt-4 border-t border-gray-50">
                    Pembayaran dilakukan <strong>setelah cucian ditimbang oleh kurir</strong>. Kamu bisa membayar melalui berbagai metode digital yang tersedia di aplikasi kami, seperti transfer Bank (BCA/Mandiri/dll), QRIS, atau E-Wallet (GoPay, OVO). Kami tidak menerima pembayaran tunai demi keamanan bersama.
                </div>
            </details>

            <!-- FAQ 4 -->
            <details class="faq-item group bg-white rounded-2xl shadow-sm border border-gray-100 p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                <summary class="flex justify-between items-center font-bold text-gray-800 outline-none">
                    <span class="text-lg">Berapa lama proses cucian saya akan selesai?</span>
                    <span class="transition-transform duration-300 group-open:rotate-180 shrink-0 text-[#0074A6] bg-blue-50 w-8 h-8 flex items-center justify-center rounded-full ml-4">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </summary>
                <div class="text-gray-500 mt-4 leading-relaxed font-medium pt-4 border-t border-gray-50">
                    Untuk layanan reguler, proses pengerjaan memakan waktu 2-3 hari kerja. Namun, jika kamu sedang terburu-buru, kami juga menyediakan opsi <strong>Layanan Kilat (Express 24 Jam)</strong> dengan sedikit tambahan biaya.
                </div>
            </details>

            <!-- FAQ 5 -->
            <details class="faq-item group bg-white rounded-2xl shadow-sm border border-gray-100 p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                <summary class="flex justify-between items-center font-bold text-gray-800 outline-none">
                    <span class="text-lg">Apakah pakaian saya dicampur dengan milik orang lain?</span>
                    <span class="transition-transform duration-300 group-open:rotate-180 shrink-0 text-[#0074A6] bg-blue-50 w-8 h-8 flex items-center justify-center rounded-full ml-4">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </summary>
                <div class="text-gray-500 mt-4 leading-relaxed font-medium pt-4 border-t border-gray-50">
                    Tentu saja tidak! Kami menerapkan sistem <strong>1 Pelanggan = 1 Mesin</strong>. Pakaianmu tidak akan pernah dicampur dengan pakaian pelanggan lain untuk menjaga tingkat higienitas, kebersihan, dan mencegah risiko luntur.
                </div>
            </details>

            <!-- Pesan kalau pencarian gak ketemu -->
            <div id="emptyState" class="hidden text-center py-10">
                <div class="text-gray-300 mb-4 text-5xl"><i class="fas fa-search-minus"></i></div>
                <h3 class="text-xl font-bold text-gray-700">Oops, nggak ketemu!</h3>
                <p class="text-gray-500 mt-2 font-medium">Coba gunakan kata kunci lain ya.</p>
            </div>

        </div>

        <!-- Call to Action Bantuan CS -->
        <div class="mt-12 bg-blue-50 rounded-[2rem] p-8 text-center border border-blue-100 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="text-left md:w-2/3">
                <h3 class="text-xl font-bold text-gray-800 mb-2">Masih punya pertanyaan?</h3>
                <p class="text-gray-600 font-medium text-sm">Tim Customer Support kami siap membantu menyelesaikan masalahmu kapan saja.</p>
            </div>
            <a href="https://wa.me/6287791039341?text=Halo%20Admin%20Washly,%20saya%20butuh%20bantuan%20terkait%20laundry%20saya%20nih." target="_blank" class="w-full md:w-auto bg-[#0074A6] hover:bg-[#005a82] text-white font-bold py-3.5 px-8 rounded-full text-sm shadow-md transition whitespace-nowrap inline-flex items-center justify-center gap-2">
                <i class="fab fa-whatsapp text-lg"></i> Hubungi CS
            </a>
        </div>
    </main>

    {{-- SCRIPT PENCARIAN AJAIB 🪄 --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const faqItems = document.querySelectorAll('.faq-item');
            const emptyState = document.getElementById('emptyState');

            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                let hasVisibleItems = false;

                faqItems.forEach(item => {
                    const textContent = item.textContent.toLowerCase();
                    if (textContent.includes(searchTerm)) {
                        item.style.display = 'block';
                        hasVisibleItems = true;
                    } else {
                        item.style.display = 'none';
                    }
                });

                if (hasVisibleItems) {
                    emptyState.classList.add('hidden');
                } else {
                    emptyState.classList.remove('hidden');
                }
            });
        });
    </script>
</body>
</html>
