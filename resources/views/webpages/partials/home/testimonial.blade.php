<section class="bg-white py-16 px-4 md:px-20">
    <div class="max-w-4xl mx-auto text-center mb-12" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-bold text-blue-800">Apa Kata Mereka ?</h2>
        <p class="text-gray-500 mt-2">Beberapa testimoni dari orang tua dan alumni kami</p>
    </div>

    <div class="swiper-testimonial overflow-hidden" data-aos="fade-up" data-aos-delay="200">
        <div class="swiper-wrapper">
            @foreach ($testimoni->content as $item)
                <div class="swiper-slide p-4">
                    <div
                        class="bg-gray-50 rounded-2xl p-6 shadow-[10px_10px_0px_rgba(0,0,0,1)] ring-black ring-2 flex flex-col items-center text-center mb-3 transition-all duration-300 w-full md:w-3/4 mx-auto">
                        <img src="{{ asset('storage/' . $item['icon']) }}" alt="Avatar"
                            class="w-32 h-32 rounded-full object-cover mb-4" />
                        <h5 class="font-semibold text-lg text-blue-800 mb-1">{{ $item['name'] }}</h5>
                        <p class="text-sm text-gray-500 mb-2">{{ $item['as'] }}</p>
                        <p
                            class="text-gray-700 line-clamp-3 hover:line-clamp-none transition-all duration-300 ease-in-out max-h-fit overflow-hidden">
                            {{ $item['description'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- <div class="swiper-pagination mt-10"></div> --}}
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slideCount = document.querySelectorAll('.swiper-testimonial .swiper-slide').length;

        new Swiper('.swiper-testimonial', {
            loop: slideCount > 1, // hanya loop kalau ada lebih dari 1
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            grabCursor: true,
            slidesPerView: 1,
            spaceBetween: 20,
        });
    });
</script>
