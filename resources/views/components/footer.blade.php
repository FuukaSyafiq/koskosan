<footer class="bg-gradient-to-r from-lime-500 to-green-600 text-white py-10">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="space-y-4">
            <h3 class="text-xl font-bold">{{ config('app.name') }}</h3>
            <p class="text-sm">Kos premium di Ngawi, Jawa Timur. Memadukan kenyamanan dan akses strategis untuk
                mahasiswa dan pekerja muda.</p>
        </div>
        <div class="space-y-4">
            <h3 class="text-xl font-bold">Kontak</h3>
            <p class="text-sm"><i class="bi bi-telephone-fill mr-2"></i>+62 812 3456 7890</p>
            <p class="text-sm"><i class="bi bi-envelope-fill mr-2"></i>info@ayongekost.id</p>
            <p class="text-sm"><i class="bi bi-geo-alt-fill mr-2"></i>Ngawi, Jawa Timur, Indonesia</p>
        </div>
        <div class="space-y-4">
            <h3 class="text-xl font-bold">Ikuti Kami</h3>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-lime-200"><i class="bi bi-facebook text-2xl"></i></a>
                <a href="#" class="hover:text-lime-200"><i class="bi bi-instagram text-2xl"></i></a>
                <a href="#" class="hover:text-lime-200"><i class="bi bi-twitter text-2xl"></i></a>
            </div>
        </div>
    </div>
    <div class="mt-8 text-center text-sm">
        © {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved.
    </div>
</footer>
