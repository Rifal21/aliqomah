@extends('layouts.master')

@section('content')
    <div class="min-h-screen pt-24 pb-16 px-4 md:px-8 bg-gradient-to-b from-white to-gray-100">
        <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6 md:p-10 space-y-6">
            {{-- Icon (jika ada) --}}
            @if (!empty($program['icon']))
                <div class="w-full flex justify-center md:justify-start gap-10">
                    <img class="h-32 w-32 object-cover rounded-lg border border-gray-300 shadow"
                        src="{{ asset('storage/' . $program['icon']) }}" alt="{{ $program['title'] }}">
                        <div class="flex flex-col">
                            {{-- Judul --}}
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 text-center md:text-left">
                                {{ $program['title'] }}
                            </h1>
                            {{-- Deskripsi Singkat --}}
                            @if (!empty($program['description']))
                                <p class="text-gray-700 text-lg leading-relaxed text-justify">
                                    {{ $program['description'] }}
                                </p>
                            @endif
                        </div>
                </div>
            @endif



            {{-- Penjelasan Lengkap --}}
            @if (!empty($program['long_description']))
                <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
                    {!! $program['long_description'] !!}
                </div>
            @endif

            {{-- Link Eksternal --}}
            @if (!empty($program['link']))
                <div class="pt-4">
                    <a href="{{ $program['link'] }}" target="_blank"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-200">
                        Kunjungi Halaman Program →
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
