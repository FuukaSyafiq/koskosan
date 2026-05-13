<x-header />

<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-8 space-y-6">
        <h1 class="text-3xl font-bold text-center text-gray-800">Daftar</h1>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input id="name" type="text" name="name" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-lime-600" placeholder="Contoh: Andi Nugroho" />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" type="email" name="email" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-lime-600" placeholder="Contoh: email@gmail.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>
            <div>
                <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">No WA / Telp</label>
                <input id="contact" type="text" name="contact" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-lime-600" placeholder="Input no telpon" />
                <x-input-error :messages="$errors->get('contact')" class="mt-1" />
            </div>
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Asal</label>
                <input id="address" type="text" name="address" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-lime-600" placeholder="Alamat" />
                <x-input-error :messages="$errors->get('address')" class="mt-1" />
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-lime-600" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-lime-600" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>
           
            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}" class="text-sm text-lime-600 hover:underline">Sudah punya akun? Masuk</a>
                <button type="submit" class="px-6 py-2 bg-lime-600 text-white rounded-md hover:bg-lime-700 transition">Daftar</button>
            </div>
        </form>
    </div>
</div>
