<div class="max-w-full mx-auto py-12 px-4">
    <h2 class="text-4xl font-bold text-center mb-12">Sambutan Alumni</h2>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">

            @foreach ($alumnis['content'] as $alumni)
                <div
                    class="swiper-slide flex flex-row bg-white border-b-8 border-r-4 border-l-3 border-t-1 shadow-lg rounded-2xl p-6 md:p-10 max-h-[50vh] overflow-auto">
                    <div class="flex flex-col md:flex-row h-full w-full">
                        {{-- Foto --}}
                        <div
                            class="flex-shrink-0 flex justify-center items-center mb-6 md:mb-0 md:sticky md:top-0 md:h-full md:w-64">
                            <img src="{{ asset('storage/' . $alumni['icon']) }}" alt="{{ $alumni['name'] }}"
                                class="md:w-full w-64 h-64 md:h-full object-cover rounded-tr-4xl border-4 border-black shadow-md">
                        </div>

                        {{-- Sambutan --}}
                        <div class="md:pl-10 flex-1 overflow-y-auto">
                            <div
                                class="text-gray-700 leading-relaxed text-justify indent-8
                                [&>h1]:text-3xl [&>h2]:text-2xl [&>h3]:text-xl
                                [&>ul]:list-disc [&>ul]:pl-5 [&>ol]:list-decimal [&>ol]:pl-5
                                [&>blockquote]:border-l-4 [&>blockquote]:pl-4 [&>blockquote]:italic
                                [&>a]:text-blue-600 [&>a]:underline
                                [&>strong]:font-semibold [&>em]:italic">
                                {!! $alumni['description'] !!}</div>
                            <div class="mt-6 text-end">
                                <h3 class="text-xl font-semibold text-black">{{ $alumni['name'] }}</h3>
                                <p class="text-sm text-gray-600">{{ $alumni['as'] }} | Angkatan
                                    {{ $alumni['angkatan'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        {{-- Pagination & Navigation --}}
        <div class="swiper-pagination mt-8"></div>
        {{-- <div class="swiper-button-prev text-blue-600"></div>
        <div class="swiper-button-next text-blue-600"></div> --}}
    </div>
</div>

{{-- Swiper JS Init --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper(".mySwiper", {
            loop: true,
            grabCursor: true,
            autoplay: {
                delay: 7000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                1024: {
                    slidesPerView: 1,
                },
            },
        });
    });
</script>
