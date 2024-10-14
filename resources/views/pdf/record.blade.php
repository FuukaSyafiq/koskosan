<!DOCTYPE html>
<html>

<head>
    <title>Detail Transaction</title>
    <!-- Import Tailwind classes via Curlwind -->
    <link rel="stylesheet"
        href="https://cdn.curlwind.com?classes=text-center,text-2xl,font-bold,text-lg,italic,mb-4,mb-6,mt-6,p-6,mx-auto,my-24,my-auto,my-6,w-4/5,border,border-black,bg-gray-200,py-2,px-4,w-48,h-auto">
</head>

<body>

    <!-- Title -->
    <h1 class="text-center text-2xl font-bold mb-4">Transaction Detail</h1>
    <hr class="border-black mb-4">

    <!-- Transaction Information -->
    <div class="mb-6">
        <p class="text-lg"><strong>No:</strong> {{ $record->no_invoice }}</p>
        <p class="text-lg"><strong>Tanggal Dibayar:</strong> {{ $record->tanggal_dibayar }}</p>
    </div>

    <!-- Table Section -->
    <div class="my-6">
        <table class="w-4/5 mx-auto my-24 border border-black">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-black py-2 px-4 text-center">Pengirim</th>
                    <th class="border border-black py-2 px-4 text-center">Kamar</th>
                    <th class="border border-black py-2 px-4 text-center">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-black py-2 px-4 text-center">{{ $record->pengirim }}</td>
                    <td class="border border-black py-2 px-4 text-center">{{ $record->room }}</td>
                    <td class="border border-black py-2 px-4 text-center">Rp.
                        {{ number_format($record->amount, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Image Section -->
    <p class="text-lg"><strong>Bukti Pembayaran:</strong></p>
    @if ($image_base64)
        <div>
            <div class="my-6 mx-auto">
                <img class="w-60 h-auto mx-auto object-cover" src="{{ $image_base64 }}" alt="Invoice Image">
            </div>
        </div>
    @else
        <div>
            <div class="my-6 mx-auto">
                <p class="text-center italic">Tidak ada bukti pembayaran</p>
            </div>
        </div>
    @endif


</body>

</html>
