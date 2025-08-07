<section class="bg-gray-50 w-full flex flex-col items-center py-16 px-4 md:px-10 overflow-hidden">
    <!-- Judul -->
    <div class="text-center mb-16" data-aos="fade-down">
        <p class="text-blue-700 text-lg font-semibold mb-3">Our Program</p>
        <h2 class="text-3xl md:text-4xl font-bold text-blue-800">Pendidikan Berbasis Karakter</h2>
        <div class="w-20 h-1 bg-blue-300 mx-auto mt-4"></div>
    </div>

    <!-- Untuk Mobile: Swiper -->
    <div class="w-full max-w-6xl md:hidden">
        <div class="swiper">
            <div class="swiper-wrapper">
                @foreach ($program->content as $item)
                    {{-- {{ dd($item) }} --}}
                    <div class="swiper-slide p-4">
                        <div
                            class="bg-gray-100 rounded-2xl p-8 flex flex-col items-center shadow-[10px_10px_0px_rgba(0,0,0,1)] ring-gray-300 ring-2 transition-transform duration-300">
                            <div class=" text-white px-10 rounded-full mb-6 flex items-center justify-center">
                                <img src="{{ asset('storage/' . $item['icon']) }}" class="w-40" alt="">
                            </div>
                            <h3 class="text-lg font-semibold mb-4">{{ $item['title'] }}</h3>
                            <p class="text-gray-600 text-center mb-5 text-sm">
                                {{ $item['description'] }}
                            </p>
                            <a href="{{ route('webpages.showProgram', $item['id']) }}"
                                class="bg-blue-700 text-white px-5 py-2 rounded-full flex items-center gap-2 hover:bg-blue-800 text-sm">
                                <i class="fas fa-arrow-right"></i> Check
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Optional: Pagination -->
            {{-- <div class="swiper-pagination mt-6"></div> --}}
        </div>
    </div>

    <!-- Untuk Desktop: Grid -->
    <div class="w-full max-w-6xl hidden md:grid grid-cols-3 gap-8">
        @foreach ($program->content as $key => $item)
            <div class="bg-gray-100 rounded-2xl p-10 flex flex-col items-center  shadow-3xl ring-gray-300 ring-2 hover:shadow-[10px_10px_0px_rgba(0,0,0,1)] hover:scale-105 transition-all duration-300"
                data-aos="fade-up" data-aos-delay="{{ $key * 200 }}">
                <div class="text-white px-10 rounded-full mb-6 w-full flex items-center justify-center">
                    <img src="{{ asset('storage/' . $item['icon']) }}" class="w-40" alt="">
                </div>
                <h3 class="text-xl font-semibold mb-5">{{ $item['title'] }}</h3>
                <p class="text-gray-600 text-center mb-3">
                    {{ $item['description'] }}
                </p>
                <a href="{{ route('webpages.showProgram', $item['id']) }}"
                    class="bg-blue-700 text-white px-6 py-2.5 rounded-full flex items-center gap-2 hover:bg-blue-800">
                    <i class="fas fa-arrow-right"></i> Check
                </a>
            </div>
        @endforeach
    </div>


</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.swiper', {
            slidesPerView: 1.2,
            spaceBetween: 20,
            centeredSlides: true,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            effect: 'flip',
            grabCursor: true,
        });
    });
</script>
