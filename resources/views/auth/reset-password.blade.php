<x-layout>
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md mx-auto my-12">
        <h2 class="text-2xl font-bold text-center mb-6">Kata sandi Baru</h2>

        @if(session('error'))
<div class="bg-red-500 text-white p-4 rounded">
    {{ session('error') }}
</div>
@endif
@if(session('success'))
<div class="bg-green-500 text-white p-4 rounded">
    {{ session('success') }}
</div>
@endif


        {{-- Formulir pendaftaran --}}
        <form method="POST" action="{{route('password.update')}}">
            @csrf
            <input type="hidden" name="token" value="{{$token}}">


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

            {{-- Konfirmasi Password --}}
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Konfirmasi kata sandi</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            {{-- Tombol Register --}}
            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-layout>
