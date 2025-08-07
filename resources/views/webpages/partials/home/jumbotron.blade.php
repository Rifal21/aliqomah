<section id="home" class="relative bg-center bg-no-repeat bg-cover bg-gray-600/50 bg-blend-multiply min-h-screen"
    style="background-image: url('{{ asset('storage/' . $jumbotron->content['background']) }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
    <div
        class="px-4 mx-auto max-w-screen-xl text-center flex flex-col justify-center items-center h-full py-32 lg:py-52">
        <img src="{{ asset('storage/' . $jumbotron->content['logo']) }}" alt="Logo"
            class="mx-auto w-32 sm:w-72 mb-6 object-cover" data-aos="fade-down" data-aos-delay="100" />

        <h1 class="mb-6 text-2xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl"
            data-aos="fade-up" data-aos-delay="300">
            {{ $jumbotron->content['tagline'] }}
        </h1>

        <h3 class="mb-6 text-lg font-normal text-white lg:text-3xl sm:px-16 lg:px-48" data-aos="fade-up"
            data-aos-delay="500">
            {{ $jumbotron->content['subtagline'] }}
        </h3>

        <div class="flex items-center space-y-4 justify-center" data-aos="fade-up" data-aos-delay="700">
            <a href="{{ route('webpages.about') }}"
                class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-white rounded-lg bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-300 dark:focus:ring-emerald-900">
                Pelajari Selengkapnya
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
    </div>
</section>
