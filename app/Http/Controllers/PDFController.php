<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VerifikasiPembayaran;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use PDF;

class PDFController extends Controller
{
    public function transactionpdf($id)
    {
        // Get the transaction
        $transaction = VerifikasiPembayaran::find($id);

        // Get the image path based on the bukti_file value
        $image = Image::where('id', $transaction->bukti_file)->first();

        //splice "/storage/" if exist so the link is not broken
        $image_path = $image->path;
        if (strpos($image_path, '/storage/') === 0) {
            // Remove the '/storage/' from the path
            $image_path = substr($image_path, strlen('/storage/'));
        }

        // Get the full path to the image file
        $filePath = storage_path('app/public/' . $image_path);
        // dd($filePath);

        // Convert the image to base64 if the file exists
        $base64Image = null;
        if (file_exists($filePath)) {
            $imageData = file_get_contents($filePath);
            $imageType = pathinfo($filePath, PATHINFO_EXTENSION);
            $base64Image = 'data:image/' . $imageType . ';base64,' . base64_encode($imageData);
        }
        // dd($base64Image);
        
        // Prepare the data to pass to the PDF view
        $data = [
            'record' => $transaction,
            'image_base64' => $base64Image, // Pass the base64 encoded image
        ];

        // Load the view for the PDF
        $pdf = PDF::loadView('pdf.record', $data);

        // return $pdf->download('transaction-' . $transaction->id . '.pdf');
        return $pdf->stream('test.pdf');
    }
}
