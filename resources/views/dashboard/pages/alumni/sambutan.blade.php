@extends('layouts.masterAdmin')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 capitalize">{{ $pages->name }} - {{ $pages->section }}</h1>

        <form action="{{ route('pages.update', $pages->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div id="Testimonis-wrapper" class="space-y-8">
                @foreach (old('content', $pages->content ?? []) as $index => $Testimoni)
                    <div class="p-6 border rounded-md bg-gray-50 relative">
                        <button type="button" onclick="removeTestimoni(this)"
                            class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-xl font-bold">&times;</button>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="content[{{ $index }}][name]"
                                value="{{ old('content.' . $index . '.name', $Testimoni['name'] ?? '') }}"
                                class="mt-2 w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pekerjaan / Sebagai</label>
                            <input type="text" name="content[{{ $index }}][as]"
                                value="{{ old('content.' . $index . '.as', $Testimoni['as'] ?? '') }}"
                                class="mt-2 w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Angkatan</label>
                            <input type="text" name="content[{{ $index }}][angkatan]"
                                value="{{ old('content.' . $index . '.angkatan', $Testimoni['angkatan'] ?? '') }}"
                                class="mt-2 w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Sambutan</label>

                            <div class="quill-editor mt-2 w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                data-name="content[{{ $index }}][description]"
                                data-content="{{ htmlentities(old('content.' . $index . '.description', $Testimoni['description'] ?? '')) }}">
                            </div>
                        </div>


                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profile</label>
                            <div class="flex flex-col items-center justify-center w-full border-2 border-dashed border-gray-300 rounded-md p-6 hover:border-blue-400 cursor-pointer"
                                onclick="document.getElementById('icon-{{ $index }}').click()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16V4m0 0l-3 3m3-3l3 3m4 6v8m0 0l-3-3m3 3l3-3M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2h-4l-2-2H9L7 6H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-500">Klik untuk upload atau drag n drop</p>
                                <p class="text-xs text-gray-400">SVG, PNG, JPG, GIF (Max 2MB)</p>
                            </div>
                            <input type="file" id="icon-{{ $index }}" name="content[{{ $index }}][icon]"
                                accept="image/*" class="hidden" onchange="previewImage(event, 'icon-{{ $index }}')">

                            <div id="preview-icon-{{ $index }}"
                                class="mt-4 @if (empty($Testimoni['icon'])) hidden @endif">
                                <h3 class="font-semibold text-gray-700 mb-2">Preview Icon</h3>
                                <img id="preview-icon-{{ $index }}-image"
                                    src="{{ isset($Testimoni['icon']) ? asset('storage/' . $Testimoni['icon']) : '#' }}"
                                    alt="Icon Preview" class="w-32 h-32 object-cover rounded-md border border-gray-300">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div>
                <button type="button" onclick="addTestimoni()"
                    class="py-3 px-6 bg-green-600 text-white rounded-md hover:bg-green-700 focus:ring-2 focus:ring-green-500">
                    + Tambah Sambutan
                </button>
            </div>

            <div>
                <button type="submit"
                    class="w-full py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                    Simpan Semua Perubahan
                </button>
            </div>
        </form>
    </div>

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
        let TestimoniIndex = {{ count(old('content', $pages->content ?? [])) }};
        let editors = {};

        document.addEventListener('DOMContentLoaded', function() {
            initializeAllQuillEditors();
        });

        function initializeAllQuillEditors() {
            document.querySelectorAll('.quill-editor').forEach((el) => {
                const name = el.getAttribute('data-name');

                if (el.classList.contains('quill-initialized')) return;

                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = name;
                el.parentNode.insertBefore(hiddenInput, el.nextSibling);

                const quill = new Quill(el, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{
                                'header': [1, 2, false]
                            }],
                            ['bold', 'italic', 'underline', 'blockquote'],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            ['link', 'image'],
                            ['clean']
                        ]
                    }
                });

                const initialContent = el.getAttribute('data-content') || '';
                quill.root.innerHTML = decodeHTMLEntities(initialContent);
                hiddenInput.value = quill.root.innerHTML;

                quill.on('text-change', function() {
                    hiddenInput.value = quill.root.innerHTML;
                });

                editors[name] = quill;
                el.classList.add('quill-initialized');
            });
        }

        // Fungsi bantu untuk decode isi dari data-content
        function decodeHTMLEntities(text) {
            const textarea = document.createElement('textarea');
            textarea.innerHTML = text;
            return textarea.value;
        }


        function addTestimoni() {
            const wrapper = document.getElementById('Testimonis-wrapper');
            const newIndex = TestimoniIndex;

            const template = `<div class="p-6 border rounded-md bg-gray-50 relative">
                <button type="button" onclick="removeTestimoni(this)"
                    class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-xl font-bold">&times;</button>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="content[${newIndex}][name]"
                        class="mt-2 w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Pekerjaan / Sebagai</label>
                    <input type="text" name="content[${newIndex}][as]"
                        class="mt-2 w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Angkatan</label>
                    <input type="text" name="content[${newIndex}][angkatan]" class="mt-2 w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Sambutan</label>
                    <div class="quill-editor mt-2 w-full p-3 border border-gray-300 rounded-md" name="content[${newIndex}][description]" required></div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profile</label>
                    <div class="flex flex-col items-center justify-center w-full border-2 border-dashed border-gray-300 rounded-md p-6 hover:border-blue-400 cursor-pointer"
                        onclick="document.getElementById('icon-${newIndex}').click()">
                        <p class="text-gray-500">Klik untuk upload atau drag n drop</p>
                    </div>
                    <input type="file" id="icon-${newIndex}" name="content[${newIndex}][icon]" accept="image/*" class="hidden"
                        onchange="previewImage(event, 'icon-${newIndex}')">

                    <div id="preview-icon-${newIndex}" class="mt-4 hidden">
                        <h3 class="font-semibold text-gray-700 mb-2">Preview Icon</h3>
                        <img id="preview-icon-${newIndex}-image" src="#" alt="Icon Preview"
                            class="w-32 h-32 object-cover rounded-md border border-gray-300">
                    </div>
                </div>
            </div>`;

            wrapper.insertAdjacentHTML('beforeend', template);
            setTimeout(() => {
                initializeAllQuillEditors();
            }, 100);

            TestimoniIndex++;
        }

        function removeTestimoni(button) {
            const parent = button.closest('.p-6');
            parent.remove();
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
    </script>
@endsection
