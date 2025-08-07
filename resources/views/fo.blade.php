<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LPI AL-IQOMAH</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="min-h-screen bg-[url('{{ asset('images/fo/clbg2e.png') }}')] bg-cover bg-center flex flex-col items-center text-center text-gray-900">

    <!-- Header -->
    <div class="mt-6 px-4">
        <img src="https://aliqomah.com/fo/img/logolpia.png" alt="Logo" class="mx-auto w-20 sm:w-24" />
        <h1 class="text-lg sm:text-xl font-semibold mt-4">LPI AL-IQOMAH</h1>
        <p class="text-sm sm:text-base leading-tight">Mencetak Generasi Qurani,<br />Membangun Masyarakat Madani</p>
        <p class="text-red-600 font-semibold mt-1 text-sm">Beta Version</p>
    </div>

    <!-- Menu Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-8 mt-6 px-4 w-full max-w-2xl">
        <!-- Contoh item menu -->
        <a href="{{ route('webpages.home') }}"
            class="bg-slate-100 hover:bg-50 bg-opacity-80 rounded-xl p-4 shadow-2xl hover:shadow-xl transition">
            <img src="{{ asset('images/fo/earth.png') }}" alt="Webpage" class="mx-auto w-16 h-16" />
            <p class="mt-2 text-sm font-semibold">WEBPAGE</p>
        </a>
        <a href="#"
            class="bg-slate-100 hover:bg-50 bg-opacity-80 rounded-xl p-4 shadow-2xl hover:shadow-xl transition">
            <img src="{{ asset('images/fo/folderuser.png') }}" alt="PPDB" class="mx-auto w-16 h-16" />
            <p class="mt-2 text-sm font-semibold">PPDB</p>
        </a>
        <a href="#"
            class="bg-slate-100 hover:bg-50 bg-opacity-80 rounded-xl p-4 shadow-2xl hover:shadow-xl transition">
            <img src="{{ asset('images/fo/book.png') }}" alt="Blog" class="mx-auto w-16 h-16" />
            <p class="mt-2 text-sm font-semibold">BLOG</p>
        </a>
        <a href="#"
            class="bg-slate-100 hover:bg-50 bg-opacity-80 rounded-xl p-4 shadow-2xl hover:shadow-xl transition">
            <img src="{{ asset('images/fo/board.png') }}" alt="Class" class="mx-auto w-16 h-16" />
            <p class="mt-2 text-sm font-semibold">CLASS</p>
        </a>
        <a href="#"
            class="bg-slate-100 hover:bg-50 bg-opacity-80 rounded-xl p-4 shadow-2xl hover:shadow-xl transition">
            <img src="{{ asset('images/fo/calender.png') }}" alt="Events" class="mx-auto w-16 h-16" />
            <p class="mt-2 text-sm font-semibold">EVENTS</p>
        </a>
        <a href="#"
            class="bg-slate-100 hover:bg-50 bg-opacity-80 rounded-xl p-4 shadow-2xl hover:shadow-xl transition">
            <img src="{{ asset('images/fo/chat.png') }}" alt="Social" class="mx-auto w-16 h-16" />
            <p class="mt-2 text-sm font-semibold">SOCIAL</p>
        </a>
        <a href="#"
            class="bg-slate-100 hover:bg-50 bg-opacity-80 rounded-xl p-4 shadow-2xl hover:shadow-xl transition">
            <img src="{{ asset('images/fo/movies.png') }}" alt="Video" class="mx-auto w-16 h-16" />
            <p class="mt-2 text-sm font-semibold">VIDEO</p>
        </a>
        <a href="#"
            class="bg-slate-100 hover:bg-50 bg-opacity-80 rounded-xl p-4 shadow-2xl hover:shadow-xl transition">
            <img src="{{ asset('images/fo/pictures.png') }}" alt="Images" class="mx-auto w-16 h-16" />
            <p class="mt-2 text-sm font-semibold">IMAGES</p>
        </a>
        <a href="#"
            class="bg-slate-100 hover:bg-50 bg-opacity-80 rounded-xl p-4 shadow-2xl hover:shadow-xl transition">
            <img src="{{ asset('images/fo/music.png') }}" alt="Radio" class="mx-auto w-16 h-16" />
            <p class="mt-2 text-sm font-semibold">RADIO</p>
        </a>
        <a href="#"
            class="bg-slate-100 hover:bg-50 bg-opacity-80 rounded-xl p-4 shadow-2xl hover:shadow-xl transition">
            <img src="{{ asset('images/fo/podcast.png') }}" alt="Podcast" class="mx-auto w-16 h-16" />
            <p class="mt-2 text-sm font-semibold">PODCAST</p>
        </a>
        <a href="#"
            class="bg-slate-100 hover:bg-50 bg-opacity-80 rounded-xl p-4 shadow-2xl hover:shadow-xl transition">
            <img src="{{ asset('images/fo/moneygold.png') }}" alt="Donate" class="mx-auto w-16 h-16" />
            <p class="mt-2 text-sm font-semibold">DONATE</p>
        </a>
        <a href="#"
            class="bg-slate-100 hover:bg-50 bg-opacity-80 rounded-xl p-4 shadow-2xl hover:shadow-xl transition">
            <img src="{{ asset('images/fo/user.png') }}" alt="Silpia" class="mx-auto w-16 h-16" />
            <p class="mt-2 text-sm font-semibold">SILPIA</p>
        </a>
    </div>

    <!-- Footer -->
    <div class="mt-10 mb-6 text-center px-4">
        <a href="https://wa.me/your-number" target="_blank">
            <img src="https://aliqomah.com/fo/img/WApng.png" alt="WhatsApp" class="mx-auto w-16 h-16" />
        </a>
        <p class="text-xs text-gray-800 mt-2">Presented by</p>
        <img src="https://aliqomah.com/fo/img/lpiamediacenter.png" alt="Media Center" class="mx-auto w-24" />
        <p class="text-xs mt-1 text-gray-700">aliqomah © 1991–{{ date('Y') }}. All Rights Reserved.</p>
    </div>

</body>

</html>
