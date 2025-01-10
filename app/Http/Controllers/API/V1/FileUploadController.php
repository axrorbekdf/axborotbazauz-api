<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpPresentation\IOFactory as PresentationIOFactory;


class FileUploadController extends Controller
{
    public function readPdfAndReadWordPages(Request $request)
    {
        // Validayatsiya

        $validate = validate($request->all(), [
            'file' => 'required|mimes:pdf,docx,doc,pptx,ppt|max:20480', // Faqat PDF fayllar uchun
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

        if (strtolower($file->getClientOriginalExtension()) === "pptx") {

            $scriptPath = app_path('app/scripts/script.py');
            
            // Argumentlarni yuborish
            $arg1 = escapeshellarg($request->input('arg1', storage_path("app/public/".$filePath))); // Birinchi argument
            // $arg2 = escapeshellarg($request->input('arg2', 'default2')); // Ikkinchi argument

            // Python skriptni ishga tushirish
            $output = shell_exec("python $scriptPath $arg1 2>&1");
            // // PPTX faylni o‘qish
            // $pptFileFullPath = storage_path('app/public/' . $filePath);
            // $presentation = PresentationIOFactory::load($pptFileFullPath);

            // // Word faylni yaratish
            // $phpWord = new PhpWord();
            // $section = $phpWord->addSection([
            //     'orientation' => 'landscape'
            // ]);

            // // Slaydlarni o‘qish va Wordga yozish
            // foreach ($presentation->getAllSlides() as $slideIndex => $slide) {
            //     $section->addText("Slayd #" . ($slideIndex + 1), ['bold' => true, 'size' => 16]);

            //     foreach ($slide->getShapeCollection() as $shape) {
            //         if ($shape instanceof \PhpOffice\PhpPresentation\Shape\RichText) {
            //             foreach ($shape->getParagraphs() as $paragraph) {
            //                 $section->addText($paragraph->getPlainText(), ['size' => 12]);
            //             }
            //         }

            //         // Agar rasm bo'lsa, uni Wordga qo'shish
            //         if ($shape instanceof \PhpOffice\PhpPresentation\Shape\Media) {
            //             // Rasmni olish
            //             $imagePath = $shape->getPath();

            //             // Word hujjatiga rasm qo'shish
            //             if (file_exists($imagePath)) {
            //                 $section->addImage($imagePath, [
            //                     'width' => $shape->getWidth(),  // Rasmning kengligi
            //                     'height' => $shape->getHeight(), // Rasmning balandligi
            //                     'wrappingStyle' => 'inline',    // Rasmni joylashuvi
            //                 ]);
            //             }
            //         }
            //     }

            //     $section->addPageBreak(); // Yangi sahifaga o'tkazib ketadi har bir slideni

            //     // $section->addTextBreak(2); // Slaydlar orasida bo‘sh joy
            // }

            // // Word faylni saqlash
            // $wordFilePath = storage_path('app/public/uploads/'.$fayl_upload_tima.'/'. $fayl_upload_tima . '-'.Str::slug($basename).'.docx');
            // $wordWriter = IOFactory::createWriter($phpWord, 'Word2007');
            // $wordWriter->save($wordFilePath);
            
            // Fayl yo‘lini ajratish
            $info = pathinfo($filePath);

            // Yangi kengaytma bilan fayl yo‘li
            $filePath = $info['dirname'] . '/' . $info['filename'] . '.pdf';
        }
        

        

        // if (strtolower($file->getClientOriginalExtension()) === "docx") {
        if (file_exists(storage_path("app/public/".$filePath)) && strtolower($file->getClientOriginalExtension()) === "docx") {

            $docxFilePath = storage_path('app/public/'.$filePath);
            $fileName = $fayl_upload_tima . '-' . Str::slug($basename).'.pdf';
            $pdfFilePath = storage_path('app/public/uploads/'.$fayl_upload_tima.'/'.$fileName);

            $phpWord = IOFactory::load($docxFilePath, 'Word2007');

            // PDF formatida saqlash
            $domPdfPath = \PhpOffice\PhpWord\Settings::setPdfRendererPath(base_path('vendor/dompdf/dompdf'));
            \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

            $writer = IOFactory::createWriter($phpWord, 'PDF');
            $writer->save($pdfFilePath);

            
            if (!file_exists($pdfFilePath)) {
                return response()->json(['message' => 'DOCX faylni PDFga aylantirib bo‘lmadi.'], 500);
            }

            // Fayl yo‘lini ajratish
            $info = pathinfo($filePath);

            // Yangi kengaytma bilan fayl yo‘li
            $filePath = $info['dirname'] . '/' . $info['filename'] . '.pdf';
        }

        // Faqat PDF fayllar uchun rasmga aylantirish
        $pageToImages = [];

        if (file_exists(storage_path("app/public/".$filePath))) {
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

        return successResponse([
            'message' => 'PDF sahifalari muvaffaqiyatli o‘qildi!',
            'filePath' => $filePath, //http://127.0.0.1:8000/storage/
            'size' => round(Storage::size("public/".$filePath) / (1024 * 1024), 2)."MB",
            'type' => $extension,
            'pages' => $allPages, // Har bir sahifani alohida ko‘rsatish
        ]);
    }



}
