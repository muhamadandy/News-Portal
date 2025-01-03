{{-- resources/views/auth/login.blade.php --}}
<x-layout>
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md mx-auto my-12">
        <h2 class="text-2xl font-bold text-center mb-6">Masuk ke akun</h2>

        @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if ($errors->has('email'))
    <div class="alert alert-danger">
        {{ $errors->first('email') }}
    </div>
@endif

        {{-- Formulir Login --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Alamat Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror">

                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Kata Sandi</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('password') border-red-500 @enderror">

                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-gray-700">Ingat saya</label>
            </div>

            {{-- Tombol Login --}}
            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                    Masuk
                </button>
            </div>
        </form>

        {{-- Lupa Password --}}
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                <a href="{{route('password.request')}}" class="text-blue-500 hover:underline">Lupa kata sandi?</a>
            </p>
        </div>

        {{-- Belum punya akun? --}}
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Daftar</a>
            </p>
        </div>
    </div>
</x-layout>
