<div data-dial-init class="fixed end-6 bottom-6  z-[50]">
    <div id="speed-dial-menu-vertical" class="flex flex-col items-center hidden mb-4 space-y-2">
        <a href="{{ route('webpages.home') }}" data-tooltip-target="tooltip-download" data-tooltip-placement="left"
            class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-xs dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
            <i class="fa-solid fa-home text-2xl"></i>
            <span class="sr-only">Beranda</span>
            </>
            <div id="tooltip-download" role="tooltip"
                class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                Beranda
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <a href="https://wa.me/6281283337777" data-tooltip-target="tooltip-copy" data-tooltip-placement="left"
                class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 dark:hover:text-white shadow-xs dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                <i class="fa-brands fa-whatsapp text-2xl"></i>
                <span class="sr-only">WhatsApp</span>
            </a>
            <div id="tooltip-copy" role="tooltip"
                class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                WhatsApp
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
    </div>
    <button type="button" data-dial-toggle="speed-dial-menu-vertical" aria-controls="speed-dial-menu-vertical"
        aria-expanded="false"
        class="flex items-center justify-center text-white bg-emerald-700 rounded-full w-14 h-14 hover:bg-emerald-800 dark:bg-emerald-600 dark:hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-300 focus:outline-none dark:focus:ring-emerald-800 cursor-pointer group">
        <i class="fa-solid fa-chevron-down transition-transform group-hover:rotate-180"></i>
        <span class="sr-only">Open actions menu</span>
    </button>
</div>
