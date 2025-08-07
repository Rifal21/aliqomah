<footer class="bg-gray-100 pt-10">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Map -->
        @if (Request::routeIs('webpages.home'))
            <div class="w-full h-72 mb-8">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.7158728138925!2d108.14357817592065!3d-7.158810792845684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f4eabcdd2d6f7%3A0x3e589fbb4ff353c!2sLPI%20AL-IQOMAH!5e0!3m2!1sen!2sid!4v1745681052625!5m2!1sen!2sid"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        @endif

        <!-- Address and Social Links -->
        <div class="text-center mb-8 border-t border-gray-300 pt-4">
            <h3 class="text-lg font-semibold mb-2">Kampus/Kantor</h3>
            <p class="text-gray-700 text-sm">
                Jalan Kusnadi Belanegara Kp. Kaum Tengah RT. 001 RW. 003 Desa Ciawi Kecamatan Ciawi
                Kabupaten Tasikmalaya Provinsi Jawa Barat<br>
                Kode Pos 46156 ☎️ Telp. (0265) 455603
            </p>

            <!-- Social Icons -->
            <div class="flex justify-center space-x-4 mt-4">
                <a href="#" class="text-blue-600 hover:text-blue-800 text-2xl">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#" class="text-pink-500 hover:text-pink-700 text-2xl">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="text-sky-400 hover:text-sky-600 text-2xl">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-red-500 hover:text-red-700 text-2xl">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="#" class="text-gray-600 hover:text-gray-800 text-2xl">
                    <i class="fab fa-tiktok"></i>
                </a>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-300 pt-4 pb-6 text-center text-gray-600 text-sm">
            <div class="space-x-4 mb-2">
                <a href="#" class="hover:underline">Copyrights</a>
                <a href="#" class="hover:underline">Disclaimer</a>
                <a href="#" class="hover:underline">Tentang Situs</a>
                <a href="#" class="hover:underline">Peta Situs</a>
            </div>
            <p>aliqomah © 1991-{{ date('Y') }}. All rights reserved.</p>
        </div>
    </div>
</footer>
