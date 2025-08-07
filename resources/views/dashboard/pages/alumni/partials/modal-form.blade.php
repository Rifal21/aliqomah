<div x-show="showAlumniModal" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0 bg-black/30">
        <!-- Background overlay -->
        {{-- <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75" @click="closeModal"></div>
        </div> --}}
        
        <!-- Modal container -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <!-- Modal header -->
            <div class="bg-blue-600 px-4 py-3 sm:px-6 sm:flex sm:items-center sm:justify-between">
                <h3 class="text-lg leading-6 font-medium text-white" x-text="modalTitle"></h3>
                <button @click="closeModal" class="text-white hover:text-blue-100 focus:outline-none">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="px-4 py-5 sm:p-6">
                <form @submit.prevent="submitForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" x-model="formMethod">
                    <input type="hidden" name="id" x-model="formData.id">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Kolom kiri -->
                        <div class="space-y-4">
                            <!-- Nama -->
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" id="nama" x-model="formData.nama" 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <p class="mt-1 text-sm text-red-600" x-show="errors.nama" x-text="errors.nama"></p>
                            </div>
                                                        <!-- Nama Ayah-->
                            <div>
                                <label for="bin" class="block text-sm font-medium text-gray-700">Nama Ayah</label>
                                <input type="text" id="bin" x-model="formData.bin" 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <p class="mt-1 text-sm text-red-600" x-show="errors.bin" x-text="errors.bin"></p>
                            </div>
                            
                            <!-- NIS -->
                            <div>
                                <label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
                                <input type="text" id="nis" x-model="formData.nis" 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <p class="mt-1 text-sm text-red-600" x-show="errors.nis" x-text="errors.nis"></p>
                            </div>
                            
                            <!-- Tahun Lulus -->
                            <div>
                                <label for="tahun_lulus" class="block text-sm font-medium text-gray-700">Tahun Lulus</label>
                                <select id="tahun_lulus" x-model="formData.tahun_lulus" 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">Pilih Tahun</option>
                                    <template x-for="year in yearOptions" :key="year">
                                        <option :value="year" x-text="year"></option>
                                    </template>
                                </select>
                                <p class="mt-1 text-sm text-red-600" x-show="errors.tahun_lulus" x-text="errors.tahun_lulus"></p>
                            </div>
                            
                            <!-- Kelas -->
                            <div>
                                <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                                <input type="text" id="kelas" x-model="formData.kelas" 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <p class="mt-1 text-sm text-red-600" x-show="errors.kelas" x-text="errors.kelas"></p>
                            </div>
                        </div>
                        
                        <!-- Kolom kanan -->
                        <div class="space-y-4">
                            <!-- Jenis Kelamin -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <div class="mt-1 space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" x-model="formData.sex" value="L" 
                                            class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                        <span class="ml-2 text-sm text-gray-700">Laki-laki</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" x-model="formData.sex" value="P" 
                                            class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                        <span class="ml-2 text-sm text-gray-700">Perempuan</span>
                                    </label>
                                </div>
                                <p class="mt-1 text-sm text-red-600" x-show="errors.sex" x-text="errors.sex"></p>
                            </div>
                            
                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select id="status" x-model="formData.status" 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">Pilih Status</option>
                                    <option value="AKTIF">Aktif</option>
                                    <option value="ALUMNI">Alumni</option>
                                    <option value="NON AKTIF">Non Aktif</option>
                                </select>
                                <p class="mt-1 text-sm text-red-600" x-show="errors.status" x-text="errors.status"></p>
                            </div>
                            
                            <!-- Foto -->
                            <div>
                                <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                                <div class="mt-1 flex items-center">
                                    <template x-if="formData.foto">
                                        <img :src="formData.foto.startsWith('http') ? formData.foto : '/storage/' + formData.foto" 
                                            class="h-16 w-16 rounded-full object-cover mr-4">
                                    </template>
                                    <input type="file" id="foto" @change="handleFileUpload" 
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                </div>
                                <p class="mt-1 text-sm text-red-600" x-show="errors.foto" x-text="errors.foto"></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tombol aksi -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" @click="closeModal" 
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Batal
                        </button>
                        <button type="submit" 
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <span x-text="isSubmitting ? 'Menyimpan...' : 'Simpan'"></span>
                            <i class="fas fa-spinner fa-spin ml-2" x-show="isSubmitting"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>