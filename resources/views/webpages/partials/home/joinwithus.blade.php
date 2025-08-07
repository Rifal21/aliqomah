<section
    class="bg-gray-100 px-6 md:px-10 py-10 flex flex-col md:flex-row items-center justify-center gap-16 min-h-screen overflow-hidden">

    <!-- Gambar Santri + Counter -->
    <div class="relative flex flex-col items-center " data-aos="fade-right">
        <div class="absolute -top-10 -left-10 w-40 h-40 bg-blue-100 rounded-full blur-2xl opacity-70"></div>

        <img src="{{ asset('images/content/SoloMaleFX-241x300.png') }}" alt="Santri"
            class="max-w-[250px] w-[350px] md:max-w-lg z-10 relative transition-transform duration-300 hover:scale-105 drop-shadow-xl">

        <div class="text-center mt-10">
            <h3 class="text-blue-700 text-3xl sm:text-3xl font-semibold mb-3">Jumlah Lulusan</h3>
            <p id="lulusan-counter" class="text-red-600 text-6xl md:text-7xl font-extrabold tracking-wide">0</p>
            <p class="text-gray-500 italic text-sm mt-2">* sejak 1991</p>
        </div>
    </div>

    <!-- Card Alumni & Sahabat -->
    <div class="flex flex-col gap-10 w-full md:w-1/2" data-aos="fade-left">

        <!-- Alumni -->
        <div class="rounded-2xl  p-8 flex gap-6 hover:shadow-2xl transition-all duration-300">
            <div class="flex items-center justify-center min-w-[64px] h-16 border-2 border-green-400 rounded-full">
                <i class="fas fa-users text-3xl text-green-400"></i>
            </div>
            <div class="flex flex-col">
                <h4 class="text-green-500 text-xl sm:text-3xl font-bold mb-2">IKA LPI AL-IQOMAH</h4>
                <p class="text-gray-500 text-sm sm:text-lg leading-relaxed mb-5">
                    Ikatan Keluarga Alumni (IKA) Al-Iqomah merupakan wadah silaturahmi alumni semua angkatan. Yuk gabung
                    supaya
                    jaringan alumni makin kuat!
                </p>
                <a href="{{ route('webpages.alumni') }}"
                    class="bg-green-400 hover:bg-green-500 text-white font-semibold px-5 py-2 rounded-full text-lg w-max shadow-md hover:shadow-lg">
                    <i class="fas fa-user-plus mr-2"></i> Gabung IA
                </a>
            </div>
        </div>

        <!-- Sahabat Hati -->
        <div class=" rounded-2xl  p-8 flex gap-6 hover:shadow-2xl transition-all duration-300">
            <div class="flex items-center justify-center min-w-[64px] h-16 border-2 border-pink-400 rounded-full">
                <i class="fas fa-hand-holding-heart text-3xl text-pink-400"></i>
            </div>
            <div class="flex flex-col">
                <h4 class="text-pink-500 text-xl sm:text-3xl font-bold mb-2">Program Sahabat Hati</h4>
                <p class="text-gray-500 text-sm sm:text-lg leading-relaxed mb-5">
                    Bantu beasiswa yatim dan dhuafa di lingkungan LPI AL-IQOMAH lewat program donasi ini.
                </p>
                <div class="flex flex-wrap gap-4">
                    <button
                        class="bg-pink-400 hover:bg-pink-500 text-white font-semibold px-5 py-2 rounded-full text-lg w-max shadow-md hover:shadow-lg">
                        <i class="fas fa-hand-holding-heart mr-2"></i> Jadi Sahabat
                    </button>
                    <button
                        class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-5 py-2 rounded-full text-lg w-max shadow-md hover:shadow-lg">
                        <i class="fas fa-donate mr-2"></i> Kirim Donasi
                    </button>
                </div>
            </div>
        </div>

    </div>

</section>

<!-- Counter Animation Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const counter = document.getElementById('lulusan-counter');
        const target = 3364;
        let count = 0;
        const speed = 30; // smaller = faster

        const updateCounter = () => {
            if (count < target) {
                count += Math.ceil(target / 100); // step
                if (count > target) count = target;
                counter.textContent = count.toLocaleString();
                setTimeout(updateCounter, speed);
            }
        };

        // Start counting when visible
        const observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) {
                updateCounter();
                observer.disconnect();
            }
        }, {
            threshold: 0.5
        });

        observer.observe(counter);
    });
</script>
