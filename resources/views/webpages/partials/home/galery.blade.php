<section class="bg-gray-50 py-10  px-4 md:px-20">
    <div class="max-w-6xl mx-auto text-center mb-12" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-bold text-blue-800">Galeri</h2>
        <p class="text-gray-500 mt-2">Dokumentasi kegiatan kami dalam foto dan video</p>
    </div>

    <!-- Grid untuk desktop -->
    <div class="hidden md:grid grid-cols-3 gap-6" data-aos="fade-up" data-aos-delay="200">

        @foreach ($galeri->content as $item)
            @if ($item['type'] === 'image')
                <div class="rounded-lg overflow-hidden shadow-md">
                    <img src="{{ asset('storage/' . $item['icon']) }}" alt="Galeri Foto"
                        class="w-full h-96 object-cover" />
                </div>
            @elseif ($item['type'] === 'youtube')
                @php
                    $videoId = '';
                    if (\Illuminate\Support\Str::contains($item['youtube'], 'youtube.com/watch?v=')) {
                        $videoId = \Illuminate\Support\Str::after($item['youtube'], 'v=');
                        $videoId = \Illuminate\Support\Str::before($videoId, '&');
                    } elseif (\Illuminate\Support\Str::contains($item['youtube'], 'youtu.be/')) {
                        $videoId = \Illuminate\Support\Str::after($item['youtube'], 'youtu.be/');
                    }
                    $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                @endphp
                <div class="rounded-lg overflow-hidden shadow-md">
                    <iframe class="w-full h-96" src="{{ $embedUrl }}" title="YouTube video" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            @endif
        @endforeach

    </div>

    <!-- Swiper untuk mobile -->
    <div class="swiper-gallery md:hidden overflow-hidden" data-aos="fade-up" data-aos-delay="300">
        <div class="swiper-wrapper">

            @foreach ($galeri->content as $item)
                @if ($item['type'] === 'image')
                    <div class="swiper-slide p-2">
                        <img src="{{ asset('storage/' . $item['icon']) }}" alt="Galeri Foto"
                            class="w-full h-60 object-cover rounded-lg shadow-md" />
                    </div>
                @elseif ($item['type'] === 'youtube')
                    @php
                        $videoId = '';
                        if (\Illuminate\Support\Str::contains($item['youtube'], 'youtube.com/watch?v=')) {
                            $videoId = \Illuminate\Support\Str::after($item['youtube'], 'v=');
                            $videoId = \Illuminate\Support\Str::before($videoId, '&');
                        } elseif (\Illuminate\Support\Str::contains($item['youtube'], 'youtu.be/')) {
                            $videoId = \Illuminate\Support\Str::after($item['youtube'], 'youtu.be/');
                        }
                        $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                    @endphp
                    <div class="swiper-slide p-2">
                        <iframe class="w-full h-60" src="{{ $embedUrl }}" title="YouTube video" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.swiper-gallery', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 20,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
        });
    });
</script>
