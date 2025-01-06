<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    public function readPdfPages(Request $request)
    {
        // Validayatsiya

        $validate = validate($request->all(), [
            'file' => 'required|mimes:pdf|max:20480', // Faqat PDF fayllar uchun
        ]);
    
        if ($validate !== true) return $validate;

        
        // Faylni yuklash
        $file = $request->file('file');
        // Fayl nomini va kengaytmasini ajratib olish
        $fileInfo = pathinfo($file->getClientOriginalName());
        $basename = $fileInfo['filename']; // Fayl nomi (kengaytmasiz)
        $extension = $fileInfo['extension']; // Fayl kengaytmasi
        
        $fayl_upload_tima = time();
        $fileName = $fayl_upload_tima . '-' . Str::slug($basename).'.'.$extension;

        $filePath = $file->storeAs('uploads/'.$fayl_upload_tima,$fileName, 'public');


        // Faqat PDF fayllar uchun rasmga aylantirish
        $pageToImages = [];
        if ($file->getClientOriginalExtension() === $extension) {
            $pdf = new Pdf(Storage::disk('public')->path($filePath));

            // Har bir sahifani aylantirish
            foreach (range(1, $pdf->getNumberOfPages()) as $page) {
                $imageName = $fayl_upload_tima."/page-{$page}.jpg"; 
                $imagePath = storage_path("app/public/uploads/{$imageName}");

                // $imagePath = storage_path("app/public/uploads/page-{$page}.jpg");
                $pdf->setPage($page)->saveImage($imagePath);
                $pageToImages[] = "uploads/{$imageName}";

                // $imagePath = storage_path('app/public/uploads/page-1.jpg'); // Original rasm yo‘li
                $outputPath = storage_path("app/public/uploads/{$fayl_upload_tima}/page-{$page}-watermarked.jpg"); // Saqlash uchun yo‘l



                // Rasmni yuklash
                $image = imagecreatefromjpeg($imagePath);

                // Matn rangini belgilash (Oq rang)
                $textColor = imagecolorallocate($image, 0, 0, 0);
                $lightBlack = imagecolorallocate($image, 185, 185, 185); // Ochiq qora (kul rang)


                // Shrift yo‘li
                $fontPath = public_path('fonts/arial.ttf'); // TTF shrift fayli

                // Matnni rasmga qo‘shish
                $text = "AXBOROTBAZA.UZ";

                // Rasm o‘lchamini olish
                $imageWidth = imagesx($image);
                $imageHeight = imagesy($image);

                // Matn o‘lchamini belgilash
                $fontSize = 120; // Shrift hajmi
                $angle = 55; // Matn burchagi

                // Matn o‘lchamini hisoblash
                $textBox = imagettfbbox($fontSize, $angle, $fontPath, $text);
                $textWidth = abs($textBox[4] - $textBox[0]); // Matnning kengligi
                $textHeight = abs($textBox[5] - $textBox[1]); // Matnning balandligi

                // Markazga joylashish uchun koordinatalar
                $x = ($imageWidth - $textWidth) / 2;
                $y = ($imageHeight + $textHeight) / 2;

                // Matnni rasmga qo‘shish
                imagettftext($image, $fontSize, $angle, $x, $y, $lightBlack, $fontPath, $text);

                // Rasmni saqlash
                imagejpeg($image, $outputPath);
                // imagejpeg($image, $imagePath);

                // Rasmni tozalash
                imagedestroy($image);

            }
        }
        
        // PDF Parser orqali matnni o‘qib olish
        $pdfParser = new Parser();
        $pdf = $pdfParser->parseFile(storage_path('app/public/' . $filePath));
        $pages = $pdf->getPages(); // Har bir sahifa uchun ob'ekt

        // Har bir sahifa matnini olish
        $allPages = [];
        foreach ($pages as $pageNumber => $page) {
            $allPages[] = [
                "content" => $page->getText(),
                "number" => $pageNumber+1,
                "path" => $pageToImages[$pageNumber]
            ]; // Sahifani o‘qish va raqam bilan bog‘lash
        }

        return response()->json([
            'message' => 'PDF sahifalari muvaffaqiyatli o‘qildi!',
            'pages' => $allPages, // Har bir sahifani alohida ko‘rsatish
            // 'rasmlar' => $extractedTexts
        ]);
    }
}
