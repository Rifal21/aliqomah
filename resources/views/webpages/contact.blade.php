@extends('layouts.master')

@section('content')
    <section class="bg-gray-100 min-h-screen flex items-center justify-center py-20"
        style="background-image: url('https://aliqomah.com/fo/img/clbg2e.png'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
        <div class="max-w-6xl w-full mx-auto px-4 flex flex-col md:flex-row items-center gap-8">
            <!-- Gambar -->
            <div class="w-full ">
                <img src="{{ asset('images/content/duo.png') }}" alt="Kontak Kami" class="rounded-lg w-full">
            </div>

            <!-- Form Kontak -->
            <div class="w-full  bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Kontak Kami</h2>
                <form action="#" method="POST" class="space-y-4">
                    <div>
                        <label for="nama" class="block text-gray-700 font-semibold mb-1">Nama</label>
                        <input type="text" id="nama" name="nama" required
                            class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                        <input type="email" id="email" name="email" required
                            class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="pesan" class="block text-gray-700 font-semibold mb-1">Pesan</label>
                        <textarea id="pesan" name="pesan" rows="5" required
                            class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded transition duration-300">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
