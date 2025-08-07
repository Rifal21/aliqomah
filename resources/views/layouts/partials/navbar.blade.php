<nav id="navbar" class="fixed w-full z-20 top-0 start-0 transition-all duration-300 bg-transparent">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ url('/home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/fo/logolpia.png') }}" class="h-8 transition-all duration-300" alt="Aliqomah Logo"
                id="navbar-logo">
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white transition-all duration-300"
                id="navbar-title">Aliqomah</span>
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <button type="button"
                class="text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 font-bold focus:outline-none focus:ring-emerald-300 rounded-lg text-sm px-4 py-2 text-center">
                Daftar Sekarang
            </button>
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-100 md:text-gray-700 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <div class="items-center justify-between w-full md:flex md:w-auto md:order-1 hidden" id="navbar-sticky">
    <ul class="flex flex-col gap-2 p-4 md:p-0 mt-4 font-medium rounded-lg bg-white md:bg-transparent text-gray-800 md:flex-row md:space-x-8 md:mt-0 md:border-0 transition-all duration-300"
        id="navbar-links">
        <li>
            <a href="{{ route('webpages.home') }}"
                class="block px-4 py-2 rounded-md md:rounded-none transition-colors duration-200 font-bold
                {{ Request::routeIs('webpages.home') ? 'bg-emerald-600 md:bg-transparent md:border-b-5 md:border-b-green-500 text-white font-semibold' : 'hover:bg-emerald-50 md:hover:bg-transparent md:hover:border-b-5 md:hover:border-b-green-500 hover:text-emerald-600' }}">
                Beranda
            </a>
        </li>
        <li>
            <a href="{{ route('webpages.alumni') }}"
                class="block px-4 py-2 rounded-md md:rounded-none transition-colors duration-200 font-bold
                {{ Request::is('alumni*') ? 'bg-emerald-600 md:bg-transparent md:border-b-5 md:border-b-green-500 text-white font-semibold' : 'hover:bg-emerald-50 md:hover:bg-transparent md:hover:border-b-5 md:hover:border-b-green-500 hover:text-emerald-600' }}">
                Alumni
            </a>
        </li>
        <li>
            <a href="{{ route('webpages.about') }}"
                class="block px-4 py-2 rounded-md md:rounded-none transition-colors duration-200 font-bold
                {{ Request::is('tentang-kami*') ? 'bg-emerald-600 md:bg-transparent md:border-b-5 md:border-b-green-500 text-white font-semibold' : 'hover:bg-emerald-50 md:hover:bg-transparent md:hover:border-b-5 md:hover:border-b-green-500 hover:text-emerald-600' }}">
                Tentang Kami
            </a>
        </li>
        <li>
            <a href="{{ route('webpages.contact') }}"
                class="block px-4 py-2 rounded-md md:rounded-none transition-colors duration-200 font-bold
                {{ Request::routeIs('webpages.contact') ? 'bg-emerald-600 md:bg-transparent md:border-b-5 md:border-b-green-500 text-white font-semibold' : 'hover:bg-emerald-50 md:hover:bg-transparent md:hover:border-b-5 md:hover:border-b-green-500 hover:text-emerald-600' }}">
                Kontak Kami
            </a>
        </li>
    </ul>
</div>


    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('navbar');
        const title = document.getElementById('navbar-title');
        const logo = document.getElementById('navbar-logo');
        const links = document.getElementById('navbar-links');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.remove('bg-transparent');
                navbar.classList.add('bg-white/10', 'shadow-md', 'transition-all', 'duration-300', 'backdrop-blur-sm');

                // Ubah teks & logo jadi gelap
                title.classList.remove('text-white');
                title.classList.add('text-gray-900');

                logo.classList.remove('invert-0');
                logo.classList.add('invert-0'); // opsional, bisa abaikan jika logo netral

                links.classList.remove('text-white');
                links.classList.add('text-black');
            } else {
                navbar.classList.remove('bg-white/10', 'shadow-md', 'transition-all', 'duration-300', 'backdrop-blur-sm');
                navbar.classList.add('bg-transparent');

                title.classList.remove('text-gray-900');
                title.classList.add('text-white');

                logo.classList.remove('invert-0');
                logo.classList.add('invert-0'); // opsional

                links.classList.remove('text-gray-800');
                links.classList.add('text-white');
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.querySelector('[data-collapse-toggle="navbar-sticky"]');
        const navMenu = document.getElementById("navbar-sticky");

        toggleBtn.addEventListener("click", function () {
            navMenu.classList.toggle("hidden");
        });
    });
</script>
