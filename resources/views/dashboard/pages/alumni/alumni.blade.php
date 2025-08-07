@extends('layouts.masterAdmin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header Section -->
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-1">Data Alumni</h1>
            <p class="text-gray-600">Data alumni dari tahun ke tahun</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden" x-data="alumniApp()">
            <!-- Card Header with Actions -->
            <div
                class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4 flex flex-col md:flex-row justify-between items-center">
                <h2 class="text-lg md:text-xl font-semibold text-white mb-2 md:mb-0">Daftar Alumni</h2>

                <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
                    <!-- Import Button -->
                    <button @click="showImportModal = true"
                        class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center justify-center gap-2">
                        <i class="fas fa-file-import"></i>
                        <span>Import Data</span>
                    </button>

                    <!-- Add Button -->
                    <button @click="openCreateModal()"
                        class="bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg text-sm font-medium transition flex items-center justify-center gap-2">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Data</span>
                    </button>
                </div>
            </div>


            <!-- Card Content -->
            <div class="p-4 md:p-6" x-data="tableData()">
                <!-- Filters and Search Bar -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <!-- Search Input -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="search" x-model="search" placeholder="Cari nama atau NIS..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Filter Controls -->
                    <div class="flex flex-col sm:flex-row gap-2">
                        <!-- Year Filter -->
                        <div class="relative flex-1">
                            <select x-model="filterYear"
                                class="appearance-none pl-3 pr-8 py-2 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Tahun</option>
                                <template x-for="year in uniqueYears" :key="year">
                                    <option :value="year" x-text="year"></option>
                                </template>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Gender Filter -->
                        <div class="relative flex-1">
                            <select x-model="filterSex"
                                class="appearance-none pl-3 pr-8 py-2 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Gender</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Items Per Page -->
                        <div class="relative">
                            <select x-model="showData"
                                class="appearance-none pl-3 pr-8 py-2 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="100000000">Semua</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Bar -->
                <div class="flex justify-between items-center mb-4">
                    <div class="text-sm text-gray-600">
                        Menampilkan <span
                            x-text="Math.min((currentPage - 1) * perPage + 1, filteredAlumnis.length)"></span>-<span
                            x-text="Math.min(currentPage * perPage, filteredAlumnis.length)"></span> dari <span
                            x-text="filteredAlumnis.length"></span> alumni
                    </div>
                    <div class="text-sm">
                        <span class="font-medium text-gray-700">Tahun:</span>
                        <span x-text="filterYear || 'Semua'" class="text-blue-600 ml-1"></span>
                        <span class="font-medium text-gray-700 ml-3">Gender:</span>
                        <span x-text="filterSex ? (filterSex === 'L' ? 'Laki-laki' : 'Perempuan') : 'Semua'"
                            class="text-blue-600 ml-1"></span>
                    </div>
                </div>

                <!-- Table Container -->
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <!-- Table -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    @click="sortBy('no')">
                                    <div class="flex items-center">
                                        <span>No</span>
                                        <i class="fas ml-1"
                                            :class="{
                                                'fa-sort': sortColumn !== 'no',
                                                'fa-sort-up': sortColumn === 'no' &&
                                                    sortAsc,
                                                'fa-sort-down': sortColumn === 'no' && !sortAsc
                                            }"></i>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Foto
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    @click="sortBy('nama')">
                                    <div class="flex items-center">
                                        <span>Nama</span>
                                        <i class="fas ml-1"
                                            :class="{
                                                'fa-sort': sortColumn !== 'nama',
                                                'fa-sort-up': sortColumn === 'nama' &&
                                                    sortAsc,
                                                'fa-sort-down': sortColumn === 'nama' && !sortAsc
                                            }"></i>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    @click="sortBy('nis')">
                                    <div class="flex items-center">
                                        <span>NIS</span>
                                        <i class="fas ml-1"
                                            :class="{
                                                'fa-sort': sortColumn !== 'nis',
                                                'fa-sort-up': sortColumn === 'nis' &&
                                                    sortAsc,
                                                'fa-sort-down': sortColumn === 'nis' && !sortAsc
                                            }"></i>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    @click="sortBy('tahun_lulus')">
                                    <div class="flex items-center">
                                        <span>Angkatan</span>
                                        <i class="fas ml-1"
                                            :class="{
                                                'fa-sort': sortColumn !== 'tahun_lulus',
                                                'fa-sort-up': sortColumn === 'tahun_lulus' &&
                                                    sortAsc,
                                                'fa-sort-down': sortColumn === 'tahun_lulus' && !sortAsc
                                            }"></i>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="hidden md:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    @click="sortBy('kelas')">
                                    <div class="flex items-center">
                                        <span>Kelas</span>
                                        <i class="fas ml-1"
                                            :class="{
                                                'fa-sort': sortColumn !== 'kelas',
                                                'fa-sort-up': sortColumn === 'kelas' &&
                                                    sortAsc,
                                                'fa-sort-down': sortColumn === 'kelas' && !sortAsc
                                            }"></i>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="hidden md:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    @click="sortBy('sex')">
                                    <div class="flex items-center">
                                        <span>Sex</span>
                                        <i class="fas ml-1"
                                            :class="{
                                                'fa-sort': sortColumn !== 'sex',
                                                'fa-sort-up': sortColumn === 'sex' &&
                                                    sortAsc,
                                                'fa-sort-down': sortColumn === 'sex' && !sortAsc
                                            }"></i>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="hidden md:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    @click="sortBy('bin')">
                                    <div class="flex items-center">
                                        <span>Bin</span>
                                        <i class="fas ml-1"
                                            :class="{
                                                'fa-sort': sortColumn !== 'bin',
                                                'fa-sort-up': sortColumn === 'bin' &&
                                                    sortAsc,
                                                'fa-sort-down': sortColumn === 'bin' && !sortAsc
                                            }"></i>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="hidden md:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                    @click="sortBy('status')">
                                    <div class="flex items-center">
                                        <span>Status</span>
                                        <i class="fas ml-1"
                                            :class="{
                                                'fa-sort': sortColumn !== 'status',
                                                'fa-sort-up': sortColumn === 'status' &&
                                                    sortAsc,
                                                'fa-sort-down': sortColumn === 'status' && !sortAsc
                                            }"></i>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <template x-for="(alumni, index) in paginatedAlumnis" :key="alumni.id">
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                        x-text="(currentPage - 1) * perPage + index + 1"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <template x-if="alumni.foto">
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    :src="'/storage/' + alumni.foto" alt="Foto alumni">
                                            </template>
                                            <template x-if="!alumni.foto">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </template>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900" x-text="alumni.nama"></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="alumni.nis">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"
                                            x-text="alumni.tahun_lulus"></span>
                                    </td>
                                    <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                        x-text="alumni.kelas"></td>
                                    <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                        x-text="alumni.sex"></td>
                                    <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                        x-text="alumni.bin"></td>
                                    <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                            :class="{
                                                'bg-green-100 text-green-800': alumni.status === 'AKTIF',
                                                'bg-yellow-100 text-yellow-800': alumni.status === 'ALUMNI',
                                                'bg-purple-100 text-purple-800': alumni.status === 'Wirausaha',
                                                'bg-red-100 text-red-800': alumni.status === 'NON AKTIF'
                                            }"
                                            x-text="alumni.status"></span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <button @click="openEditModal(alumni)"
                                                class="text-blue-600 hover:text-blue-900 transition" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form method="POST" @submit.prevent="deleteAlumni(alumni.id)">
                                                <button type="submit" class="text-red-600 hover:text-red-900 transition"
                                                    title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <template x-if="filteredAlumnis.length === 0">
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Tidak ada data yang ditemukan
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div
                    class="mt-4 flex flex-col sm:flex-row items-center justify-between px-2 py-3 bg-white border-t border-gray-200 sm:px-6 rounded-b-lg">
                    <div class="hidden sm:block text-sm text-gray-700 mb-4 sm:mb-0">
                        Menampilkan <span class="font-medium"
                            x-text="Math.min((currentPage - 1) * perPage + 1, filteredAlumnis.length)"></span> sampai <span
                            class="font-medium" x-text="Math.min(currentPage * perPage, filteredAlumnis.length)"></span>
                        dari <span class="font-medium" x-text="filteredAlumnis.length"></span> hasil
                    </div>
                    <div class="flex-1 flex justify-between sm:justify-end space-x-2">
                        <button @click="currentPage = Math.max(currentPage - 1, 1)" :disabled="currentPage === 1"
                            class="relative inline-flex items-center px-3 py-2 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition">
                            <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                        </button>
                        <div class="flex space-x-1">
                            <template x-for="page in visiblePages()" :key="page">
                                <button @click="currentPage = page"
                                    class="relative inline-flex items-center px-3 py-2 border text-sm font-medium transition"
                                    :class="{
                                        'z-10 bg-blue-50 border-blue-500 text-blue-600': currentPage === page,
                                        'bg-white border-gray-300 text-gray-500 hover:bg-gray-50': currentPage !== page
                                    }"
                                    x-text="page">
                                </button>
                            </template>
                        </div>
                        <button @click="currentPage = Math.min(currentPage + 1, totalPages())"
                            :disabled="currentPage === totalPages() || totalPages() === 0"
                            class="relative inline-flex items-center px-3 py-2 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition">
                            Berikutnya <i class="fas fa-chevron-right ml-1"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Include Modal Form Partial -->
            @include('dashboard.pages.alumni.partials.modal-form')

            <!-- Import Modal -->
            <div x-show="showImportModal" class="fixed inset-0 overflow-y-auto " x-cloak>
                <div
                    class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0 bg-black/30">
                    {{-- <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-black/30 opacity-75" @click="showImportModal = false"></div>
                    </div> --}}
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left z-50 overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <i class="fas fa-file-import text-blue-600"></i>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Import Data Alumni</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Upload file Excel (.xlsx) yang berisi data alumni.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('alumni.import') }}" method="POST" enctype="multipart/form-data"
                                class="mt-5">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label for="file" class="block text-sm font-medium text-gray-700">File
                                            Excel</label>
                                        <div
                                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                    fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="file"
                                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                        <span>Upload file</span>
                                                        <input id="file" name="file" type="file"
                                                            class="sr-only" required>
                                                    </label>
                                                    <p class="pl-1">atau drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-500">Format .XLS, .XLSX (maks. 10MB)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="#" class="text-sm text-blue-600 hover:text-blue-500">Download
                                            template
                                            Excel</a>
                                    </div>
                                </div>
                                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                                    <button type="submit"
                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:col-start-2 sm:text-sm transition">
                                        Import Data
                                    </button>
                                    <button type="button" @click="showImportModal = false"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:col-start-1 sm:text-sm transition">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function alumniApp() {
            return {
                // Data untuk tabel
                ...tableData(),

                // Data untuk modal form
                showAlumniModal: false,
                modalTitle: 'Tambah Alumni',
                formMethod: 'POST',
                isSubmitting: false,
                errors: {},
                yearOptions: Array.from({
                    length: 20
                }, (_, i) => new Date().getFullYear() - i),
                formData: {
                    id: '',
                    nama: '',
                    nis: '',
                    tahun_lulus: '',
                    kelas: '',
                    sex: 'L',
                    status: '',
                    foto: '',
                    bin: ''
                },

                // Methods
                openCreateModal() {
                    this.resetForm();
                    this.modalTitle = 'Tambah Alumni';
                    this.formMethod = 'POST';
                    this.showAlumniModal = true;
                },

                openEditModal(alumni) {
                    this.resetForm();
                    this.modalTitle = 'Edit Alumni';
                    this.formMethod = 'PUT';
                    this.formData = {
                        id: alumni.id || '',
                        nama: alumni.nama || '',
                        nis: alumni.nis || '',
                        tahun_lulus: alumni.tahun_lulus || '',
                        kelas: alumni.kelas || '',
                        sex: alumni.sex || 'L',
                        status: alumni.status || '',
                        foto: '', // Kosongkan biar tidak kirim URL base64 atau string lama
                        bin: alumni.bin || ''
                    };
                    this.showAlumniModal = true;
                },

                closeModal() {
                    this.showAlumniModal = false;
                    this.errors = {};
                },

                resetForm() {
                    this.formData = {
                        id: '',
                        nama: '',
                        nis: '',
                        tahun_lulus: '',
                        kelas: '',
                        sex: 'L',
                        status: '',
                        foto: '',
                        bin: ''
                    };
                    this.errors = {};
                },

                handleFileUpload(e) {
                    const file = e.target.files[0];
                    if (file) {
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                this.formData.foto = e.target.result;
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                },

                submitForm() {
                    this.isSubmitting = true;
                    this.errors = {};

                    const url = this.formData.id ?
                        `/pages/alumni/alumni/${this.formData.id}` :
                        '/pages/alumni/alumni';

                    const formData = new FormData();
                    for (const key in this.formData) {
                        if (this.formData[key] !== null && this.formData[key] !== undefined) {
                            formData.append(key, this.formData[key]);
                        }
                    }

                    const fileInput = document.getElementById('foto');
                    if (fileInput.files[0]) {
                        formData.append('foto', fileInput.files[0]);
                    }
                    if (this.formMethod === 'PUT') {
                        formData.append('_method', 'PUT');
                    }
                    fetch(url, {
                            method: this.formMethod === 'PUT' ? 'POST' : 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: formData
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(err => {
                                    throw err;
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            // console.log(data);
                            if (this.formData.id) {
                                // UPDATE - Ganti item yang ada
                                this.alumnis = this.alumnis.map(item => 
                                    // console.log(item.id === data.alumni.id)
                                    item.id == data.alumni.id ? data.alumni : item
                                );
                            } else {
                                // CREATE - Tambahkan ke awal array
                                this.alumnis = [data.alumni, ...this.alumnis];
                                this.currentPage = 1;
                            }
                            
                            // Paksa update reaktivitas
                            this.alumnis = [...this.alumnis];
                            
                            this.showAlumniModal = false;
                            this.resetForm();

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.reload();
                            });

                        })
                        .catch(error => {
                            if (error.errors) {
                                this.errors = error.errors;
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: error.message || 'Terjadi kesalahan saat menyimpan data',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            }
                        })
                        .finally(() => {
                            this.isSubmitting = false;
                        });
                }
            };
        }

        function tableData() {
            return {
                search: '',
                sortColumn: 'nama',
                sortAsc: true,
                alumnis: @json($alumnis),
                currentPage: 1,
                showData: 10,
                filterYear: '',
                filterSex: '',
                showImportModal: false,


                get perPage() {
                    return parseInt(this.showData);
                },

                get filteredAlumnis() {
                    let data = [...this.alumnis];

                    if (this.search) {
                        const s = this.search.toLowerCase();
                        data = data.filter(a =>
                            (a.nama && a.nama.toLowerCase().includes(s)) ||
                            (a.nis && a.nis.toString().toLowerCase().includes(s))
                        );
                    }

                    if (this.filterYear) {
                        data = data.filter(a => a.tahun_lulus == this.filterYear);
                    }

                    if (this.filterSex) {
                        data = data.filter(a => a.sex == this.filterSex);
                    }

                    data = data.sort((a, b) => {
                        let colA = a[this.sortColumn] ?? '';
                        let colB = b[this.sortColumn] ?? '';

                        // Handle numeric comparison for numbers
                        if (!isNaN(colA) && !isNaN(colB)) {
                            colA = parseFloat(colA);
                            colB = parseFloat(colB);
                            return this.sortAsc ? colA - colB : colB - colA;
                        }

                        // String comparison
                        if (typeof colA === 'string') colA = colA.toLowerCase();
                        if (typeof colB === 'string') colB = colB.toLowerCase();

                        if (colA < colB) return this.sortAsc ? -1 : 1;
                        if (colA > colB) return this.sortAsc ? 1 : -1;
                        return 0;
                    });

                    return data;
                },

                get paginatedAlumnis() {
                    const start = (this.currentPage - 1) * this.perPage;
                    return this.filteredAlumnis.slice(start, start + this.perPage);
                },

                totalPages() {
                    return Math.ceil(this.filteredAlumnis.length / this.perPage);
                },

                visiblePages() {
                    const pages = [];
                    const maxVisible = 5;
                    let start = Math.max(1, this.currentPage - Math.floor(maxVisible / 2));
                    let end = Math.min(this.totalPages(), start + maxVisible - 1);

                    if (end - start + 1 < maxVisible) {
                        start = Math.max(1, end - maxVisible + 1);
                    }

                    for (let i = start; i <= end; i++) {
                        pages.push(i);
                    }

                    return pages;
                },

                get uniqueYears() {
                    const years = this.alumnis.map(a => a.tahun_lulus).filter(y => y);
                    return [...new Set(years)].sort((a, b) => b - a);
                },

                sortBy(column) {
                    if (this.sortColumn === column) {
                        this.sortAsc = !this.sortAsc;
                    } else {
                        this.sortColumn = column;
                        this.sortAsc = true;
                    }
                    this.currentPage = 1; // Reset to first page when sorting
                },

                deleteAlumni(id) {
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: 'Data alumni yang dihapus tidak dapat dikembalikan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/pages/alumni/alumni/${id}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        _method: 'DELETE'
                                    })
                                })
                                .then(response => {
                                    if (response.ok) {
                                        this.alumnis = this.alumnis.filter(a => a.id !== id);
                                        Swal.fire({
                                            icon: 'success',
                                            text: 'Data alumni berhasil dihapus.',
                                            toast: true,
                                            position: 'top-end',
                                            showConfirmButton: false,
                                            timer: 3000
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            text: 'Data alumni gagal dihapus.',
                                            toast: true,
                                            position: 'top-end',
                                            showConfirmButton: false,
                                            timer: 3000
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire(
                                        'Terjadi Kesalahan!',
                                        'Silakan coba lagi nanti.',
                                        'error'
                                    );
                                });
                        }
                    });
                },


                showNotification(message, type) {
                    // You can implement a toast notification here
                    Swal.fire({
                        icon: type,
                        text: message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            }
        }
    </script>
@endsection
