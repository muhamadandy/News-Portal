{{-- resources/views/auth/login.blade.php --}}
<x-layout>
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md mx-auto my-12">
        <h2 class="text-2xl font-bold text-center mb-6">Email Terdaftar</h2>

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
        <form method="POST" action="{{route('password.request')}}">
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


            {{-- Tombol Login --}}
            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                    Kirim
                </button>
            </div>
        </form>


    </div>
</x-layout>
