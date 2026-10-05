<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SiteProgress - Enterprise Site Monitoring')</title>
    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col justify-between">

    <!-- Header & Navigation Bar -->
    <header class="bg-slate-800 border-b border-slate-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <div class="flex items-center gap-3">
                <span class="bg-blue-600 text-white p-2 rounded-lg font-bold text-xl">SP</span>
                <a href="{{ route('home') }}" class="text-xl font-bold text-white tracking-wide">SiteProgress</a>
            </div>
            <nav class="flex gap-6 font-medium text-sm text-slate-300">
                <a href="{{ route('home') }}" class="hover:text-blue-400 transition-colors">Home</a>
                <a href="{{ route('about') }}" class="hover:text-blue-400 transition-colors">About</a>
                <a href="{{ route('program.index') }}" class="hover:text-blue-400 transition-colors">Program</a>
                <a href="{{ route('team.index') }}" class="hover:text-blue-400 transition-colors">Our Team</a>
                <a href="{{ route('contact') }}" class="hover:text-blue-400 transition-colors">Contact Us</a>
            </nav>
        </div>
    </header>

    <!-- Main Content Injection -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-800 border-t border-slate-700 py-6 text-center text-sm text-slate-400">
        <p>&copy; {{ date('Y') }} SiteProgress Enterprise. Built by Syntax Builders Dev Team.</p>
    </footer>

</body>
</html>