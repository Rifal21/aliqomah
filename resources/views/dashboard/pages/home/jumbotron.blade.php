@extends('layouts.masterAdmin')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 capitalize">{{ $pages->name }} - {{ $pages->section }}</h1>

        <form action="{{ route('pages.update', ['page' => $pages->slug]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')


            {{-- Tagline --}}
            <div class="mb-6">
                <label for="tagline" class="block text-sm font-medium text-gray-700">Tagline</label>
                <input id="tagline" name="content[tagline]" type="text"
                    value="{{ old('content.tagline', optional($pages->content)['tagline']) }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
            </div>

            {{-- Subtagline --}}
            <div class="mb-6">
                <label for="subtagline" class="block text-sm font-medium text-gray-700">Sub Tagline</label>
                <input id="subtagline" name="content[subtagline]" type="text"
                    value="{{ old('content.subtagline', optional($pages->content)['subtagline']) }}"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
            </div>

            {{-- Logo Upload --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                <div class="flex flex-col items-center justify-center w-full border-2 border-dashed border-gray-300 rounded-md p-6 hover:border-blue-400 cursor-pointer"
                    onclick="document.getElementById('logo').click()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16V4m0 0l-3 3m3-3l3 3m4 6v8m0 0l-3-3m3 3l3-3M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2h-4l-2-2H9L7 6H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <p class="text-gray-500">Click to upload or drag and drop</p>
                    <p class="text-xs text-gray-400">SVG, PNG, JPG, or GIF (max 2MB)</p>
                </div>
                <input type="file" id="logo" name="content[logo]" accept="image/*" class="hidden"
                    onchange="previewImage(event, 'logo')">

                {{-- Logo Preview --}}
                <div id="preview-logo-container" class="mt-4 hidden">
                    <h3 class="font-semibold text-gray-700 mb-2">Selected Logo Preview</h3>
                    <img id="preview-logo-image" src="#" alt="Logo Preview"
                        class="w-40 h-40 object-cover rounded-md border border-gray-300">
                </div>

                {{-- Current Logo --}}
                @if (optional($pages->content)['logo'])
                    <div class="mt-6">
                        <h3 class="font-semibold text-gray-700 mb-2">Current Logo</h3>
                        <img src="{{ asset('storage/' . optional($pages->content)['logo']) }}" alt="Current Logo"
                            class="w-40 h-40 object-cover rounded-md border border-gray-300">
                    </div>
                @endif

                @error('content.logo')
                    <div class="text-sm text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Background Upload --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Background</label>
                <div class="flex flex-col items-center justify-center w-full border-2 border-dashed border-gray-300 rounded-md p-6 hover:border-blue-400 cursor-pointer"
                    onclick="document.getElementById('background').click()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16V4m0 0l-3 3m3-3l3 3m4 6v8m0 0l-3-3m3 3l3-3M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2h-4l-2-2H9L7 6H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <p class="text-gray-500">Click to upload or drag and drop</p>
                    <p class="text-xs text-gray-400">SVG, PNG, JPG, or GIF (max 2MB)</p>
                </div>
                <input type="file" id="background" name="content[background]" accept="image/*" class="hidden"
                    onchange="previewImage(event, 'background')">

                {{-- Background Preview --}}
                <div id="preview-background-container" class="mt-4 hidden">
                    <h3 class="font-semibold text-gray-700 mb-2">Selected Background Preview</h3>
                    <img id="preview-background-image" src="#" alt="Background Preview"
                        class="w-40 h-40 object-cover rounded-md border border-gray-300">
                </div>

                {{-- Current Background --}}
                @if (optional($pages->content)['background'])
                    <div class="mt-6">
                        <h3 class="font-semibold text-gray-700 mb-2">Current Background</h3>
                        <img src="{{ asset('storage/' . optional($pages->content)['background']) }}"
                            alt="Current Background" class="w-40 h-40 object-cover rounded-md border border-gray-300">
                    </div>
                @endif

                @error('content.background')
                    <div class="text-sm text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="mb-6">
                <button type="submit"
                    class="w-full py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                    Update Page
                </button>
            </div>
        </form>
    </div>

    {{-- Preview Script --}}
    <script>
        function previewImage(event, type) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById(`preview-${type}-image`);
                const container = document.getElementById(`preview-${type}-container`);
                img.src = e.target.result;
                container.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    </script>
@endsection
