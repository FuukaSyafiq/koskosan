<script>
    import {
        initFlowbite
    } from "flowbite"
    initFlowbite();
</script>
@vite('resources/css/app.css')
@vite('resources/js/app.js')

<div class="pb-12 w-64">
    tes
    <div class="space-y-2 py-1">
        <div class="px-3 py-2">
            <h2 class="mb-2 px-4 text-lg font-semibold tracking-tight">
                ADMIN DASHBOARD
            </h2>
            <div class="space-y-1">
                <div id="accordion-nested-parent" data-accordion="collapse">
                    <!-- Dashboard -->
                    <h2 id="accordion-collapse-heading-1">
                        <button type="button" class="bg-zinc-900 flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl">
                            <span class="text-slate-50">Dashboard</span>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                    </div>
                    <!-- Manual Book -->
                    <h2 id="accordion-collapse-heading-2">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-2" aria-expanded="false" aria-controls="accordion-collapse-body-2">
                            <a href="#">
                                <span>Manual Book</span>
                            </a>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
                    </div>
                    <!-- Dashboard Grafik -->
                    <h2 id="accordion-collapse-heading-3">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3">
                            <a href="#">
                                <span>dashboard grafik</span>
                            </a>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-3" class="hidden" aria-labelledby="accordion-collapse-heading-3">
                    </div>
                    <!-- Data Persebaran Penduduk -->
                    <h2 id="accordion-collapse-heading-4">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-4" aria-expanded="false" aria-controls="accordion-collapse-body-4">
                            <a href="#">
                                <span>Persebaran Penduduk</span>
                            </a>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-4" class="hidden" aria-labelledby="accordion-collapse-heading-4">
                    </div>
                    <!-- Layanan tipe A -->
                    <h2 id="accordion-collapse-heading-5">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-5" aria-expanded="false" aria-controls="accordion-collapse-body-5">
                            <span>Layanan tipe A</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-5" class="hidden" aria-labelledby="accordion-collapse-heading-5">
                        <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
                            <a href="#" class="block py-2 px-3 text-sm">
                                SK Domisili Luar
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                SK Domisili Usaha
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                SK Keterangan umum
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                SK Tidak mampu
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                Surat kelahiran
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                Surat kematian
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                Surat pengantar KUA
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                Suratpengantar KUA luar
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                Surat permohonan biodata
                            </a>
                        </div>
                    </div>
                    <!-- Layanan tipe B -->
                    <h2 id="accordion-collapse-heading-6">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-6" aria-expanded="false" aria-controls="accordion-collapse-body-6">
                            <span>Layanan tipe B</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-6" class="hidden" aria-labelledby="accordion-collapse-heading-5">
                        <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
                            <a href="#" class="block py-2 px-3 text-sm">
                                Ijin keramaian
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                permohonan KTP
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                SK Umum kecamatan
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                SKTM kecamatan
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                Surat permohonan KK
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                Surat kematian
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                Surat permohonan pindah
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                waarmerking
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                Waris
                            </a>
                        </div>
                    </div>
                    <!-- Layanan Komplain -->
                    <h2 id="accordion-collapse-heading-7">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-7" aria-expanded="false" aria-controls="accordion-collapse-body-7">
                            <span>Layanan Komplain</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-7" class="hidden" aria-labelledby="accordion-collapse-heading-5">
                        <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
                            <a href="#" class="block py-2 px-3 text-sm">
                                Komplain
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                Komplain Pengguna
                            </a>
                        </div>
                    </div>
                    <!-- Master -->
                    <h2 id="accordion-collapse-heading-8">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-8" aria-expanded="false" aria-controls="accordion-collapse-body-8">
                            <span>Master</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-8" class="hidden" aria-labelledby="accordion-collapse-heading-5">
                        <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
                            <a href="#" class="block py-2 px-3 text-sm">
                                Cari pendaftar
                            </a>
                            <a href="{{ url('/dashboard') }}" class="block py-2 px-3 text-sm">
                                Data pendaftar
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                Notifikasi Surat
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                Pembetulan SKTM dinsos
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                Pembetulan surat KUA
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                Pembetulan surat KUA luar
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                pindah USER
                            </a>
                            <a href="#" class="block py-2 px-3 text-sm">
                                Reset password Petugas
                            </a>
                        </div>
                    </div>
                    <!-- Report -->
                    <h2 id="accordion-collapse-heading-9">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-9" aria-expanded="true" aria-controls="accordion-collapse-body-9">
                            <span>Report</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-9" class="hidden" aria-labelledby="accordion-collapse-heading-9">
                        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                            <!-- Nested accordion -->
                            <div id="accordion-nested-collapse" data-accordion="collapse">
                                <!-- report type A -->
                                <h2 id="accordion-nested-collapse-heading-1">
                                    <button type="button" class="flex items-center justify-between w-full p-5 rounded-t-xl font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-nested-collapse-body-1" aria-expanded="false" aria-controls="accordion-nested-collapse-body-1">
                                        <span>report type A</span>
                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                        </svg>
                                    </button>
                                </h2>
                                <div id="accordion-nested-collapse-body-1" class="hidden" aria-labelledby="accordion-nested-collapse-heading-1">
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            Buku surat kelahiran
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            Buku surat kematian
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            permohonan KTP
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            Biodata penduduk
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            Domisili luar
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            Domisili usaha
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            Keterangan umum
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            SK tidak mampu
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            surat kematian
                                        </a>
                                    </div>
                                </div>
                                <!-- report type B -->
                                <h2 id="accordion-nested-collapse-heading-2">
                                    <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-nested-collapse-body-2" aria-expanded="false" aria-controls="accordion-nested-collapse-body-2">
                                        <span>Report type B</span>
                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                        </svg>
                                    </button>
                                </h2>
                                <div id="accordion-nested-collapse-body-2" class="hidden" aria-labelledby="accordion-nested-collapse-heading-2">
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            Buku mutasi penduduk
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            Buku mutasi penduduk keluar
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            SK pindah
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            SK tidak mampu kecamatan
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            SK umum kecamatan
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            SP kartu keluarga
                                        </a>
                                    </div>
                                </div>
                                <!-- Report Grafik -->
                                <h2 id="accordion-nested-collapse-heading-3">
                                    <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-nested-collapse-body-3" aria-expanded="false" aria-controls="accordion-nested-collapse-body-3">
                                        <span>Report Grafik</span>
                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                        </svg>
                                    </button>
                                </h2>
                                <div id="accordion-nested-collapse-body-3" class="hidden" aria-labelledby="accordion-nested-collapse-heading-3">
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            Rekap surat per Layanan
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            Rekap surat per Tipe
                                        </a>
                                    </div>
                                </div>
                                <!-- Report pemadanan -->
                                <h2 id="accordion-nested-collapse-heading-4">
                                    <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-nested-collapse-body-4" aria-expanded="false" aria-controls="accordion-nested-collapse-body-4">
                                        <span>Report Pemadanan</span>
                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                        </svg>
                                    </button>
                                </h2>
                                <div id="accordion-nested-collapse-body-4" class="hidden" aria-labelledby="accordion-nested-collapse-heading-4">
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            pemadanan Data
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            pemadanan Grafik
                                        </a>
                                    </div>
                                </div>
                                <!-- laporan kuisioner -->
                                <h2 id="accordion-nested-collapse-heading-5">
                                    <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-nested-collapse-body-5" aria-expanded="false" aria-controls="accordion-nested-collapse-body-5">
                                        <span>Laporan kuisioner</span>
                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                        </svg>
                                    </button>
                                </h2>
                                <div id="accordion-nested-collapse-body-5" class="hidden" aria-labelledby="accordion-nested-collapse-heading-5">
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            Survey kepuasan pengguna
                                        </a>
                                    </div>
                                </div>
                                <!-- report Dinsos -->
                                <h2 id="accordion-nested-collapse-heading-6">
                                    <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-nested-collapse-body-6" aria-expanded="false" aria-controls="accordion-nested-collapse-body-6">
                                        <span>Report Dinsos</span>
                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                        </svg>
                                    </button>
                                </h2>
                                <div id="accordion-nested-collapse-body-6" class="hidden" aria-labelledby="accordion-nested-collapse-heading-6">
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            SK dtks
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            Sk Rekap
                                        </a>
                                    </div>
                                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                        <a href="#" class="block py-2 px-3 text-sm">
                                            Sk Rekom
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
