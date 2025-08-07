        <div class="swiper swiper-alumni shadow-lg">
            <div class="swiper-wrapper">
                @foreach ($jumbotron['content'] as $flyer)
                    <div class="swiper-slide relative">
                        @if ($flyer['type'] === 'image')
                            {{-- Gambar --}}
                            <img src="{{ asset('storage/' . $flyer['icon']) }}" alt="{{ $flyer['title'] }}"
                                class="w-full lg:h-screen md:h-[350px] h-[250px] object-cover" />
                        @elseif ($flyer['type'] === 'youtube' && isset($flyer['youtube']))
                            {{-- Video YouTube --}}
                            @php
                                $videoId = \Illuminate\Support\Str::after($flyer['youtube'], 'v=');
                            @endphp
                            <iframe width="100%" height="100%"
                                class="w-full lg:h-screen md:h-[350px] h-[250px] object-cover"
                                src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&mute=1&loop=1&playlist={{ $videoId }}&controls=0&showinfo=0&modestbranding=1"
                                title="{{ $flyer['title'] }}" frameborder="0"
                                allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        @endif

                        {{-- Text Overlay --}}
                        <div
                            class="absolute inset-0 bg-gray-600/30 text-white flex flex-col lg:justify-center justify-end pb-12 md:pb-20 lg:pt-48 items-start md:px-20 px-5 text-start">
                            <h2 class="text-lg lg:text-4xl font-bold mb-2 uppercase">
                                {{ $flyer['title'] }}
                            </h2>
                            <p class="text-xs lg:text-xl capitalize">
                                {{ $flyer['description'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>

        {{-- Swiper Script --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new Swiper('.swiper-alumni', {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    disableOnInteraction: true,
                    loop: true,
                    autoplay: {
                        delay: 10000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: false,
                });
            });
        </script>