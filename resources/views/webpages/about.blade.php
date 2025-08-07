@extends('layouts.master')

@section('content')
    <div class="min-h-screen pt-16 bg-fixed bg-cover bg-center"
        style="background-image: url('{{ asset('storage/' . $about->content['background']) }}');">
        <div class="flex flex-col lg:flex-row w-full h-full items-center justify-between px-8 lg:px-20 py-10 gap-10">

            {{-- Kiri: Logo & Info --}}
            <div class="flex flex-col xl:flex-row items-center gap-8  rounded-2xl p-6 lg:w-1/2 w-full animate-fade-in">
                <img src="{{ asset('storage/' . $about->content['logo']) }}" alt="logo lpia"
                    class="w-40 lg:w-60 transition-transform hover:scale-105 duration-300">
                <div class="text-center xl:text-left">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $about->content['name'] }}</h1>
                    <p class="text-gray-700">{{ $about->content['tagline'] }}</p>
                    <p class="text-gray-700">{{ $about->content['subtagline'] }}</p>
                </div>
            </div>

            {{-- Kanan: Tabs --}}
            <div class="w-full lg:w-1/2 bg-white/20 rounded-2xl shadow-xl p-6 animate-slide-in-up md:min-h-[50vh]">
                {{-- Tabs Header --}}
                <div class="flex flex-wrap justify-center gap-2 border-b pb-4 mb-6">
                    @foreach ($about->content['about'] as $key => $item)
                        <button
                            class="tab-button px-4 py-2 rounded-t-md border border-b-0 border-gray-300 text-sm font-medium text-gray-700 transition-all duration-200 hover:bg-gray-100 relative z-10"
                            data-tab="{{ $key }}">
                            {{ $item['title'] }}
                        </button>
                    @endforeach
                </div>

                {{-- Tabs Content --}}
                @foreach ($about->content['about'] as $key => $item)
                    <div class="tab-content transition-all duration-300 ease-in-out {{ $key === 0 ? '' : 'hidden' }}"
                        id="tab-{{ $key }}">
                        <div
                            class="text-gray-700 leading-relaxed text-justify indent-8
                            [&>h1]:text-3xl [&>h2]:text-2xl [&>h3]:text-xl
                            [&>ul]:list-disc [&>ul]:pl-5 [&>ol]:list-decimal [&>ol]:pl-5
                            [&>blockquote]:border-l-4 [&>blockquote]:pl-4 [&>blockquote]:italic
                            [&>a]:text-blue-600 [&>a]:underline
                            [&>strong]:font-semibold [&>em]:italic">
                            {!! $item['description'] !!}
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>

    {{-- Tab JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const buttons = document.querySelectorAll('.tab-button');
            const contents = document.querySelectorAll('.tab-content');

            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    // Reset style
                    buttons.forEach(btn => {
                        btn.classList.remove('bg-gray-800', 'text-white', 'shadow');
                        btn.classList.add('bg-white', 'text-gray-700');
                    });

                    // Aktifkan tombol sekarang
                    button.classList.remove('bg-white', 'text-gray-700');
                    button.classList.add('bg-gray-800', 'text-white', 'shadow');

                    // Toggle konten
                    contents.forEach(content => content.classList.add('hidden'));
                    const target = document.getElementById('tab-' + button.dataset.tab);
                    if (target) target.classList.remove('hidden');
                });
            });

            // Default aktif
            if (buttons.length) {
                buttons[0].click();
            }
        });
    </script>


    {{-- Optional CSS Animations --}}
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes slide-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }

        .animate-slide-in-up {
            animation: slide-in-up 0.6s ease-out;
        }
    </style>
@endsection
