@extends('layouts.master')

@section('content')
    <section class="bg-gray-50 dark:bg-gray-100 min-h-screen flex items-center justify-center bg-cover bg-center"
        style="background-image: url('{{ asset('images/fo/clbg2e.png') }}'); background-attachment: fixed;">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <div class="text-center">
                <a href="#" class="flex flex-col items-center">
                    <img class="w-20 h-20 mb-3" src="{{ asset('images/fo/logolpia.png') }}" alt="Logo">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white uppercase">Aliqomah</h1>
                </a>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Welcome back! Please login to your account
                </p>
            </div>

            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" placeholder="name@example.com" required
                        value="{{ old('email') }}"
                        class="bg-gray-50 border @error('email') border-red-500 @else border-gray-300 @enderror text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    @error('email')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" required
                        class="bg-gray-50 border @error('password') border-red-500 @else border-gray-300 @enderror text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    @error('password')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" type="checkbox" name="remember"
                            class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded focus:ring-emerald-500">
                        <label for="remember" class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remember me</label>
                    </div>
                    <a href="#" class="text-sm text-emerald-600 hover:underline dark:text-emerald-400">Forgot
                        password?</a>
                </div>

                <button type="submit"
                    class="w-full text-white bg-gradient-to-r from-emerald-500 via-green-500 to-emerald-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-md hover:scale-105 transition-transform">
                    Sign in
                </button>
            </form>
        </div>
    </section>
@endsection
