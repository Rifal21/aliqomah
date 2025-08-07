@extends('layouts.masterAdmin')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 capitalize">{{ $pages->name }} - {{ $pages->section }}</h1>

        <form action="{{ route('pages.update', $pages->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div id="programs-wrapper" class="space-y-8">
                @foreach (old('content', $pages->content ?? []) as $index => $program)
                    <div class="p-6 border rounded-md bg-gray-50 relative">
                        <button type="button" onclick="removeProgram(this)"
                            class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-xl font-bold">&times;</button>

                        <input type="hidden" name="content[{{ $index }}][id]"
                            value="{{ old('content.' . $index . '.id', $program['id'] ?? (string) \Illuminate\Support\Str::uuid()) }}">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Judul Program</label>
                            <input type="text" name="content[{{ $index }}][title]"
                                value="{{ old('content.' . $index . '.title', $program['title'] ?? '') }}"
                                class="mt-2 w-full p-3 border border-gray-300 rounded-md" required>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                            <textarea name="content[{{ $index }}][description]" rows="4"
                                class="mt-2 w-full p-3 border border-gray-300 rounded-md" required>{{ old('content.' . $index . '.description', $program['description'] ?? '') }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Icon Program</label>
                            <div class="flex flex-col items-center justify-center w-full border-2 border-dashed border-gray-300 rounded-md p-6 cursor-pointer"
                                onclick="document.getElementById('icon-{{ $index }}').click()">
                                <p class="text-gray-500">Klik untuk upload</p>
                            </div>
                            <input type="file" id="icon-{{ $index }}" name="content[{{ $index }}][icon]" class="hidden" accept="image/*" onchange="previewImage(event, 'icon-{{ $index }}')">

                            <div id="preview-icon-{{ $index }}" class="mt-4 @if (empty($program['icon'])) hidden @endif">
                                <h3 class="font-semibold text-gray-700 mb-2">Preview Icon</h3>
                                <img id="preview-icon-{{ $index }}-image" src="{{ isset($program['icon']) ? asset('storage/' . $program['icon']) : '#' }}" class="w-32 h-32 object-cover rounded-md">
                            </div>
                        </div>

                        {{-- Quill Editor --}}
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Penjelasan Lengkap</label>
                            <input type="hidden" name="content[{{ $index }}][long_description]" id="hidden-editor-{{ $index }}">
                            <div id="editor-{{ $index }}" class="quill-editor bg-white border border-gray-300 rounded-md p-2" style="min-height: 150px;">
                                {!! old('content.' . $index . '.long_description', $program['long_description'] ?? '') !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div>
                <button type="submit"
                    class="w-full py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Simpan Semua Perubahan
                </button>
            </div>
        </form>
    </div>

    {{-- Include QuillJS --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
        let editors = {};
        let indexCounter = {{ count(old('content', $pages->content ?? [])) }};

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.quill-editor').forEach((el, idx) => {
                const editor = new Quill(el, {
                    theme: 'snow'
                });

                const hiddenInput = document.querySelector(`#hidden-editor-${idx}`);
                editor.on('text-change', function () {
                    hiddenInput.value = editor.root.innerHTML;
                });

                // Set initial value
                hiddenInput.value = editor.root.innerHTML;
                editors[`editor-${idx}`] = editor;
            });
        });

        function previewImage(event, id) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.getElementById(`preview-${id}-image`);
                const wrapper = document.getElementById(`preview-${id}`);
                img.src = e.target.result;
                wrapper.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }

        function removeProgram(btn) {
            btn.closest('.p-6').remove();
        }
    </script>
@endsection
