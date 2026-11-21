<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Portal - SiteProgress Enterprise</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0b0f19] text-slate-100 min-h-screen flex items-center justify-center p-4 font-sans">

    <div class="max-w-md w-full bg-[#121827] border border-slate-800 rounded-2xl p-8 shadow-2xl">
        {{-- Branding --}}
        <div class="text-center space-y-2 mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-blue-600 text-white font-extrabold text-xl mb-2 shadow-lg shadow-blue-600/30">
                SP
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">SiteProgress Portal</h1>
            <p class="text-xs text-slate-400">PT Tiga Cipta Selaras - Enterprise Monitoring System</p>
        </div>

        {{-- Form Login Simulasi Multi-Role --}}
        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider block">Pilih Aktor / Hak Akses (Demo Mode)</label>
                <div class="grid grid-cols-1 gap-3">
                    <label class="flex items-center gap-3 p-3 bg-slate-900 border border-slate-700/80 rounded-xl cursor-pointer hover:border-blue-500 transition-all">
                        <input type="radio" name="role" value="owner_proyek" checked class="text-blue-600 focus:ring-blue-500">
                        <div>
                            <p class="text-sm font-bold text-white">Owner Proyek (Klien)</p>
                            <p class="text-[11px] text-slate-400">Lihat progres khusus proyek pribadi</p>
                        </div>
                    </label>

                    <label class="flex items-center gap-3 p-3 bg-slate-900 border border-slate-700/80 rounded-xl cursor-pointer hover:border-blue-500 transition-all">
                        <input type="radio" name="role" value="owner_tcs" class="text-blue-600 focus:ring-blue-500">
                        <div>
                            <p class="text-sm font-bold text-white">Pemilik PT Tiga Cipta Selaras</p>
                            <p class="text-[11px] text-slate-400">Monitoring executive seluruh proyek</p>
                        </div>
                    </label>

                    <label class="flex items-center gap-3 p-3 bg-slate-900 border border-slate-700/80 rounded-xl cursor-pointer hover:border-blue-500 transition-all">
                        <input type="radio" name="role" value="pic_lapangan" class="text-blue-600 focus:ring-blue-500">
                        <div>
                            <p class="text-sm font-bold text-white">PIC / Site Supervisor</p>
                            <p class="text-[11px] text-slate-400">Input absensi & upload laporan harian</p>
                        </div>
                    </label>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-blue-600/30 transition-all text-sm">
                Masuk ke Dashboard &rarr;
            </button>
        </form>

        <p class="text-center text-[11px] text-slate-500 mt-6">
            &copy; 2026 PT Tiga Cipta Selaras. All rights reserved.
        </p>
    </div>

</body>
</html>