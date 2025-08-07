@extends('layouts.masterAdmin')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 capitalize">{{ $pages->name }} - {{ $pages->section }}</h1>

        <form action="{{ route('pages.update', $pages->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div id="Galeris-wrapper" class="space-y-8">
                @foreach (old('content', $pages->content ?? []) as $index => $Galeri)
                    <div class="p-6 border rounded-md bg-gray-50 relative">
                        <button type="button" onclick="removeGaleri(this)"
                            class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-xl font-bold">&times;</button>
                        <div class="mt-4 space-y-4">
                            <label class="block text-sm font-medium text-gray-700">Jenis Media</label>
                            <select name="content[{{ $index }}][type]"
                                onchange="toggleMediaType({{ $index }}, this.value)"
                                class="form-select border-gray-300 rounded-md">
                                <option value="image"
                                    {{ old("content.$index.type", $Galeri['type'] ?? '') == 'image' ? 'selected' : '' }}>
                                    Upload Gambar</option>
                                <option value="youtube"
                                    {{ old("content.$index.type", $Galeri['type'] ?? '') == 'youtube' ? 'selected' : '' }}>
                                    Link YouTube</option>
                            </select>

                            {{-- Judul Kegiatan --}}
                            <div class="mt-4 space-y-4">
                                <label for="icon-{{ $index }}" class="block text-sm font-medium text-gray-700">Judul Kegiatan</label>
                                <input type="text" name="content[{{ $index }}][title]"
                                    value="{{ old("content.$index.title", $Galeri['title'] ?? '') }}"
                                    class="w-full border border-gray-300 rounded-md p-2">
                            </div>

                            {{-- Deskripsi Singkat --}}
                            <div class="mt-4 space-y-4">
                                <label class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                                <textarea name="content[{{ $index }}][description]" rows="2"
                                    class="w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Tuliskan deskripsi singkat...">{{ old("content.$index.description", $Galeri['description'] ?? '') }}</textarea>
                            </div>

                            {{-- Upload Gambar --}}
                            <div id="image-input-{{ $index }}"
                                class="{{ old("content.$index.type", $Galeri['type'] ?? '') == 'youtube' ? 'hidden' : '' }}">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Gambar</label>
                                <div class="flex flex-col items-center justify-center w-full border-2 border-dashed border-gray-300 rounded-md p-6 hover:border-blue-400 cursor-pointer"
                                    onclick="document.getElementById('icon-{{ $index }}').click()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-3"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16V4m0 0l-3 3m3-3l3 3m4 6v8m0 0l-3-3m3 3l3-3M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2h-4l-2-2H9L7 6H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-gray-500">Klik untuk upload atau drag n drop</p>
                                    <p class="text-xs text-gray-400">SVG, PNG, JPG, GIF (Max 2MB)</p>
                                </div>
                                <input type="file" id="icon-{{ $index }}"
                                    name="content[{{ $index }}][icon]" accept="image/*" class="hidden"
                                    onchange="previewImage(event, 'icon-{{ $index }}')">

                                <div id="preview-icon-{{ $index }}"
                                    class="mt-4 {{ empty($Galeri['icon']) ? 'hidden' : '' }}">
                                    <h3 class="font-semibold text-gray-700 mb-2">Preview Gambar</h3>
                                    <img id="preview-icon-{{ $index }}-image"
                                        src="{{ isset($Galeri['icon']) ? asset('storage/' . $Galeri['icon']) : '#' }}"
                                        alt="Icon Preview" class="w-32 h-32 object-cover rounded-md border border-gray-300">
                                </div>
                            </div>

                            {{-- Link YouTube --}}
                            <div id="youtube-input-{{ $index }}"
                                class="{{ old("content.$index.type", $Galeri['type'] ?? '') == 'youtube' ? '' : 'hidden' }}">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Link YouTube</label>
                                <input type="url" name="content[{{ $index }}][youtube]"
                                    value="{{ old("content.$index.youtube", $Galeri['youtube'] ?? '') }}"
                                    oninput="previewYoutube(event, {{ $index }})"
                                    placeholder="https://www.youtube.com/watch?v=..."
                                    class="w-full border border-gray-300 rounded-md p-2">

                                <div id="preview-youtube-{{ $index }}"
                                    class="mt-4 {{ isset($Galeri['youtube']) ? '' : 'hidden' }}">
                                    <h3 class="font-semibold text-gray-700 mb-2">Preview YouTube</h3>
                                    <iframe id="preview-youtube-{{ $index }}-frame" width="320" height="180"
                                        class="border rounded"
                                        src="{{ isset($Galeri['youtube']) ? 'https://www.youtube.com/embed/' . \Illuminate\Support\Str::after($Galeri['youtube'], 'v=') : '' }}"
                                        frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Add New Galeri Button --}}
            <div>
                <button type="button" onclick="addGaleri()"
                    class="py-3 px-6 bg-green-600 text-white rounded-md hover:bg-green-700 focus:ring-2 focus:ring-green-500">
                    + Tambah Gambar / Video
                </button>
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit"
                    class="w-full py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                    Simpan Semua Perubahan
                </button>
            </div>
        </form>
    </div>

    {{-- Dynamic Galeri Script --}}
    <script>
        let GaleriIndex = {{ count(old('content', $pages->content ?? [])) }};

        function toggleMediaType(index, type) {
            const imageDiv = document.getElementById(`image-input-${index}`);
            const youtubeDiv = document.getElementById(`youtube-input-${index}`);
            if (type === 'image') {
                imageDiv.classList.remove('hidden');
                youtubeDiv.classList.add('hidden');
            } else {
                imageDiv.classList.add('hidden');
                youtubeDiv.classList.remove('hidden');
            }
        }

        function previewImage(event, id) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById(`preview-${id}-image`);
                const container = document.getElementById(`preview-${id}`);
                img.src = e.target.result;
                container.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }

        function previewYoutube(event, index) {
            const url = event.target.value;
            const videoId = new URL(url).searchParams.get("v");
            if (videoId) {
                const iframe = document.getElementById(`preview-youtube-${index}-frame`);
                iframe.src = `https://www.youtube.com/embed/${videoId}`;
                document.getElementById(`preview-youtube-${index}`).classList.remove('hidden');
            }
        }

        function removeGaleri(button) {
            button.parentElement.remove();
        }

        function addGaleri() {
            const wrapper = document.getElementById('Galeris-wrapper');

            const template = `
                <div class="p-6 border rounded-md bg-gray-50 relative">
                    <button type="button" onclick="removeGaleri(this)"
                        class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-xl font-bold">&times;</button>
                    <div class="mt-4 space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Jenis Media</label>
                        <select name="content[${GaleriIndex}][type]" onchange="toggleMediaType(${GaleriIndex}, this.value)"
                            class="form-select border-gray-300 rounded-md">
                            <option value="image">Upload Gambar</option>
                            <option value="youtube">Link YouTube</option>
                        </select>

                        {{-- Title --}}
                        <div class="mt-4 space-y-4">
                            <label class="block text-sm font-medium text-gray-700">Judul Kegiatan</label>
                            <input type="text" name="content[${GaleriIndex}][title]"
                                class="w-full border border-gray-300 rounded-md p-2">
                        </div>

                        {{-- Description --}}
                        <div class="mt-4 space-y-4">
                            <label class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                            <textarea name="content[${GaleriIndex}][description]" rows="2"
                                class="w-full border border-gray-300 rounded-md p-2"
                                placeholder="Tuliskan deskripsi singkat..."></textarea>
                        </div>

                        {{-- Upload Gambar --}}
                        <div id="image-input-${GaleriIndex}">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Gambar</label>
                            <div class="flex flex-col items-center justify-center w-full border-2 border-dashed border-gray-300 rounded-md p-6 hover:border-blue-400 cursor-pointer"
                                onclick="document.getElementById('icon-${GaleriIndex}').click()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16V4m0 0l-3 3m3-3l3 3m4 6v8m0 0l-3-3m3 3l3-3M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2h-4l-2-2H9L7 6H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-500">Klik untuk upload atau drag n drop</p>
                                <p class="text-xs text-gray-400">SVG, PNG, JPG, GIF (Max 2MB)</p>
                            </div>
                            <input type="file" id="icon-${GaleriIndex}" name="content[${GaleriIndex}][icon]" accept="image/*"
                                class="hidden" onchange="previewImage(event, 'icon-${GaleriIndex}')">
                            <div id="preview-icon-${GaleriIndex}" class="mt-4 hidden">
                                <h3 class="font-semibold text-gray-700 mb-2">Preview Gambar</h3>
                                <img id="preview-icon-${GaleriIndex}-image" src="#" alt="Icon Preview"
                                    class="w-32 h-32 object-cover rounded-md border border-gray-300">
                            </div>
                        </div>

                        {{-- YouTube --}}
                        <div id="youtube-input-${GaleriIndex}" class="hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Link YouTube</label>
                            <input type="url" name="content[${GaleriIndex}][youtube]" oninput="previewYoutube(event, ${GaleriIndex})"
                                placeholder="https://www.youtube.com/watch?v=..."
                                class="w-full border border-gray-300 rounded-md p-2">
                            <div id="preview-youtube-${GaleriIndex}" class="mt-4 hidden">
                                <h3 class="font-semibold text-gray-700 mb-2">Preview YouTube</h3>
                                <iframe id="preview-youtube-${GaleriIndex}-frame" width="320" height="180"
                                    class="border rounded" src="" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            `;


            wrapper.insertAdjacentHTML('beforeend', template);
            GaleriIndex++;
        }
    </script>
@endsection
