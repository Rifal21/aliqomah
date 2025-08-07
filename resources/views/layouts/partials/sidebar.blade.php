@php
    $isPagesActive = request()->is('pages*');
    $isHomeActive = request()->is('pages/home-*');
    $isAlumniActive = request()->is('pages/alumni-*') || request()->is('pages/alumni/*') ;
@endphp

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<aside id="sidebar-multi-level-sidebar"
    class="fixed top-14 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <ul class="space-y-2 font-medium cursor-pointer">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group
                    {{ request()->routeIs('dashboard.index') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                    <i class="fa-solid fa-gauge text-xl text-gray-400"></i>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            <!-- Master Pages -->
            <li x-data="{ open: {{ $isPagesActive ? 'true' : 'false' }} }">
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                    {{ $isPagesActive ? 'bg-gray-200 dark:bg-gray-700' : '' }}"
                    @click="open = !open">
                    <i class="fa-solid fa-table text-xl text-gray-400"></i>
                    <span class="flex-1 ms-3 text-left whitespace-nowrap">Master Pages</span>
                    <i :class="{ 'rotate-90': open }"
                        class="fa-solid fa-chevron-right transition-transform duration-200 {{ $isPagesActive ? 'rotate-90' : '' }}"></i>
                </button>

                <!-- Dropdown -->
                <ul x-show="open" x-cloak class="py-2 space-y-2">

                    <!-- Home Section -->
                    <li x-data="{ openHome: {{ $isHomeActive ? 'true' : 'false' }} }">
                        <button type="button" @click="openHome = !openHome"
                            class="flex justify-between items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                            {{ $isHomeActive ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                            <div>
                                <i class="fa-solid fa-home text-lg text-gray-400 mr-2"></i>Home
                            </div>
                            <i :class="{ 'rotate-90': openHome }"
                                class="fa-solid fa-chevron-right transition-transform duration-200 {{ $isHomeActive ? 'rotate-90' : '' }}"></i>
                        </button>

                        <!-- Submenu for Home -->
                        <ul x-show="openHome" x-cloak class="py-2 space-y-2 pl-10">
                            <li>
                                <a href="{{ route('pages.edit', ['page' => 'home-jumbotron']) }}"
                                    class="flex items-center w-full p-2 text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                                    {{ request()->is('*pages/home-jumbotron*') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                    <i class="fa-solid fa-cogs text-lg text-gray-400 mr-2"></i>Jumbotron
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('pages.edit', ['page' => 'home-whyme']) }}"
                                    class="flex items-center w-full p-2 text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                                    {{ request()->is('*pages/home-whyme*') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                    <i class="fa-solid fa-cogs text-lg text-gray-400 mr-2"></i>Kenapa ALiqomah
                                </a>
                            </li> --}}
                            <li>
                                <a href="{{ route('pages.edit', ['page' => 'home-program']) }}"
                                    class="flex items-center w-full p-2 text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                                    {{ request()->is('*pages/home-program*') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                    <i class="fa-solid fa-cogs text-lg text-gray-400 mr-2"></i>Program
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pages.edit', ['page' => 'home-testimoni']) }}"
                                    class="flex items-center w-full p-2 text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                                    {{ request()->is('*pages/home-testimoni*') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                    <i class="fa-solid fa-cogs text-lg text-gray-400 mr-2"></i>Testimoni
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pages.edit', ['page' => 'home-galeri']) }}"
                                    class="flex items-center w-full p-2 text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                                    {{ request()->is('*pages/home-galeri*') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                    <i class="fa-solid fa-cogs text-lg text-gray-400 mr-2"></i>Galeri
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Alumni Section -->
                    <li x-data="{ openAlumni: {{ $isAlumniActive ? 'true' : 'false' }} }">
                        <button type="button" @click="openAlumni = !openAlumni"
                            class="flex justify-between items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                            {{ $isAlumniActive ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                            <div>
                                <i class="fa-solid fa-Alumni text-lg text-gray-400 mr-2"></i>Alumni
                            </div>
                            <i :class="{ 'rotate-90': openAlumni }"
                                class="fa-solid fa-chevron-right transition-transform duration-200 {{ $isAlumniActive ? 'rotate-90' : '' }}"></i>
                        </button>

                        <!-- Submenu for Alumni -->
                        <ul x-show="openAlumni" x-cloak class="py-2 space-y-2 pl-10">
                            <li>
                                <a href="{{ route('pages.edit', ['page' => 'alumni-jumbotron']) }}"
                                    class="flex items-center w-full p-2 text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                                    {{ request()->is('*pages/alumni-jumbotron*') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                    <i class="fa-solid fa-cogs text-lg text-gray-400 mr-2"></i>Jumbotron
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('pages.edit', ['page' => 'Alumni-whyme']) }}"
                                    class="flex items-center w-full p-2 text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                                    {{ request()->is('*pages/Alumni-whyme*') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                    <i class="fa-solid fa-cogs text-lg text-gray-400 mr-2"></i>Kenapa ALiqomah
                                </a>
                            </li> --}}
                            <li>
                                <a href="{{ route('pages.edit', ['page' => 'alumni-sambutan']) }}"
                                    class="flex items-center w-full p-2 text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                                    {{ request()->is('*pages/alumni-sambutan*') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                    <i class="fa-solid fa-cogs text-lg text-gray-400 mr-2"></i>Sambutan Alumni
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('alumni.index') }}"
                                    class="flex items-center w-full p-2 text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                                    {{ request()->is('*alumni/data*') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                    <i class="fa-solid fa-cogs text-lg text-gray-400 mr-2"></i>Data Alumni
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pages.edit', ['page' => 'alumni-galeri']) }}"
                                    class="flex items-center w-full p-2 text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                                    {{ request()->is('*pages/alumni-galeri*') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                    <i class="fa-solid fa-cogs text-lg text-gray-400 mr-2"></i>Galeri Kegiatan Alumni
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- About -->
                    <li>
                        <a href="{{ route('pages.edit', ['page' => 'about']) }}"
                            class="flex items-center w-full p-2 text-gray-900 rounded-lg transition duration-75 pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                            {{ request()->is('*pages/about*') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                            <i class="fa-solid fa-info-circle text-lg text-gray-400 mr-2"></i>About
                        </a>
                    </li>

                    <!-- Contact -->
                    <li>
                        <a href="{{ route('pages.edit', ['page' => 'contact']) }}"
                            class="flex items-center w-full p-2 text-gray-900 rounded-lg transition duration-75 pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                            {{ request()->is('*pages/contact*') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                            <i class="fa-solid fa-address-book text-lg text-gray-400 mr-2"></i>Contact
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
