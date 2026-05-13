<x-header />

<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8 space-y-6">
        <h1 class="text-3xl font-bold text-center text-gray-800">Masuk</h1>
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-lime-600" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-lime-600" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>
            <div class="flex items-center justify-between">
                <a href="{{ url('/register') }}" class="text-sm text-lime-600 hover:underline">Belum punya akun?</a>
                <button type="submit" class="px-6 py-2 bg-lime-600 text-white rounded-md hover:bg-lime-700 transition">Masuk</button>
            </div>
        </form>
    </div>
</div>
