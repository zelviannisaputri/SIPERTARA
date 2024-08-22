<x-guest-layout>
    <style>
        .min-h-screen {
            min-height: 70vh;
            margin: 60px 70px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            background-color: #48bb78;
        }

        .form-container,
        .content-container {
            max-width: 400px;
            min-height: 70vh;
            margin: auto;
        }

        .flex {
            display: flex;
        }

        .justify-center {
            justify-content: center;
        }

        .items-center {
            align-items: center;
        }

        .w-full {
            width: 100%;
        }

        .md\:w-1\/2 {
            width: 50%;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .md\:px-12 {
            padding-left: 3rem;
            padding-right: 3rem;
        }

        .lg\:px-16 {
            padding-left: 4rem;
            padding-right: 4rem;
        }

        .py-8 {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        .bg-green-500 {
            background-color: #48bb78;
        }

        .text-white {
            color: #ffffff;
        }

        .text-3xl {
            font-size: 1.875rem;
            line-height: 2.25rem;
        }

        .text-4xl {
            font-size: 2.25rem;
            line-height: 2.5rem;
        }

        .font-bold {
            font-weight: 700;
        }

        .font-semibold {
            font-weight: 600;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .mb-8 {
            margin-bottom: 2rem;
        }

        .text-gray-600 {
            color: #718096;
        }

        .text-gray-900 {
            color: #1a202c;
        }

        .text-blue-500 {
            color: #4299e1;
        }

        .hover\:text-blue-700:hover {
            color: #2b6cb0;
        }

        .block {
            display: block;
        }

        .mt-1 {
            margin-top: 0.25rem;
        }

        .border-gray-300 {
            border-color: #d2d6dc;
        }

        .focus\:border-indigo-500:focus {
            border-color: #667eea;
        }

        .focus\:ring-indigo-500:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.5);
        }

        .rounded-md {
            border-radius: 0.375rem;
        }

        .shadow-sm {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .rounded {
            border-radius: 0.375rem;
        }

        .text-center {
            text-align: center;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }
    </style>

    <div class="min-h-screen flex">
        <!-- Left side (Form) -->
        <div class="w-full md:w-1/2 flex flex-col justify-center items-start px-4 md:px-12 lg:px-16 py-8 bg-white">
            <div class="form-container w-full">
                <h1 class="text-3xl font-bold mb-4">Masuk</h1>
                <p class="text-gray-600 mb-8">
                    Jika Anda tidak memiliki akun, daftar Anda Dapat
                    <a href="{{ route('register') }}" class="text-blue-500 font-semibold">Daftar Disini !</a>
                </p>
                <x-validation-errors class="mb-4" />
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <x-label for="email" value="{{ __('Alamat Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username" />
                    </div>
                    <div class="mb-3">
                        <x-label for="password" value="{{ __('Kata Sandi') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" />
                    </div>
                    <div class="flex items-center mb-3">
                        <x-checkbox id="remember_me" name="remember" />
                        <label for="remember_me" class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</label>
                    </div>
                    <div class="flex items-center justify-end mb-3">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Lupa kata sandi?') }}
                            </a>
                        @endif
                    </div>
                    <x-button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-5">
                        {{ __('Masuk') }}
                    </x-button>
                </form>
                <p class="text-gray-600 mt-10">
                    Jika Anda sudah mendaftar namun kembali ke halaman ini, berarti akun anda belum disetujui admin.
                </p>
            </div>
        </div>
        <!-- Right side (Image) -->
        <div class="md:flex md:w-1/2 bg-green-500 text-white flex justify-center items-center">
            <div class="content-container text-center">
                <h1 class="text-4xl font-bold mb-4">SIPERTARA</h1>
                <p class="mb-8">Sistem Informasi Pengelolaan dan Registrasi Tanah Rumbai Barat</p>
                <img src="{{ asset('images/logo.png') }}" alt="Illustration" class="w-2/3 mx-auto">
            </div>
        </div>
    </div>
    @if (session('message'))
    <div class="alert alert-warning mt-4">
        {{ session('message') }}
    </div>
@endif
</x-guest-layout>
