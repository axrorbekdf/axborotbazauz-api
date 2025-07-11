<?php

namespace App\Services;

use App\Http\Resources\MaterialResource;
use App\Models\Material;
use App\Models\MaterialPage;
use Illuminate\Support\Facades\Auth;
use Smalot\PdfParser\Parser;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class MaterialCRUDService extends CRUDService
{
    protected $modelClass = Material::class;
    protected $relationModelClass = MaterialPage::class;
    protected $modelResourceClass = MaterialResource::class;
    protected $withModels = ['category','subject', 'pages'];


    public function readPdfAndReadWordPages($file, $request)
    {
        // Fayl nomini va kengaytmasini ajratib olish
        $fileInfo = pathinfo($file->getClientOriginalName());
        $basename = $fileInfo['filename']; // Fayl nomi (kengaytmasiz)
        $extension = $fileInfo['extension']; // Fayl kengaytmasi
        
        $fayl_upload_tima = time();
        $fileName = $fayl_upload_tima . '-' . Str::slug($basename).'.'.$extension;

        $validate = validate([
            'slug' => Str::slug($basename)
        ], [
            'slug' => 'required|string|unique:materials,slug',
        ]);

        // Update qilishda kerak bo'ladi
        // $rules = [
        //     'slug' => 'required|string|unique:materials,slug,' . $material_id,
        // ];
    
        if ($validate !== true) return $validate;

        $filePath = $file->storeAs('uploads/'.$fayl_upload_tima,$fileName, 'public');
        $file_type = $file->getClientOriginalExtension();
        
        if (file_exists(storage_path("app/public/".$filePath)) && (strtolower($file_type) === "zip" || strtolower($file_type) === "zip")) {

            $zip = new ZipArchive();
            $zipFilePath = storage_path("app/public/".$filePath); // ZIP fayl joylashuvi
            $extractToPath = storage_path("app/public/uploads/".$fayl_upload_tima); // Chiqarish joyi
    
            if ($zip->open($zipFilePath) === TRUE) {
                $zip->extractTo($extractToPath); // Fayllarni ochish
    
                // ZIP ichidagi fayllar ro'yxatini olish
                $fileList = [];
                for ($i = 0; $i < $zip->numFiles; $i++) {
                    $fileList[] = $zip->getNameIndex($i); // Har bir fayl nomini olish
                }
                $zip->close();
                
                // return $fileList[0];
    
                if(file_exists(storage_path("app/public/uploads/".$fayl_upload_tima."/".$fileList[0]))){
    
                    // Fayl yo‘lini ajratish
                    $info = pathinfo($fileList[0]);
        
                    // Yangi kengaytma bilan fayl yo‘li
                    $filePath = "uploads/".$fayl_upload_tima . '/' . $info['basename'];
                    $file_type = $info['extension'];
                }
            } else {
                return 0;
            }
        }


        if (file_exists(storage_path("app/public/".$filePath)) && (strtolower($file_type) === "pptx" || strtolower($file_type) === "ppt")) {

            // $scriptPath = app_path('python/scripts/pptToPdfLinux.py');
            $scriptPath = app_path('python/scripts/pptToPdf.py');
            
            // Argumentlarni yuborish
            $arg1 = escapeshellarg(storage_path("app/public/".$filePath)); // Birinchi argument
            // $arg2 = escapeshellarg($request->input('arg2', 'default2')); // Ikkinchi argument

            // Python skriptni ishga tushirish
            // $output = shell_exec("python3.9 $scriptPath $arg1 2>&1");
            $output = shell_exec("python $scriptPath $arg1 2>&1");
            // return $output;
            
            // Fayl yo‘lini ajratish
            $info = pathinfo($filePath);

            // Yangi kengaytma bilan fayl yo‘li
            $filePath = $info['dirname'] . '/' . $info['filename'] . '.pdf';
        }
        

        if (file_exists(storage_path("app/public/".$filePath)) && (strtolower($file_type) === "docx" || strtolower($file_type) === "doc")) {

            // $scriptPath = app_path('python/scripts/docToPdfLinux.py');
            $scriptPath = app_path('python/scripts/docToPdf.py');
            
            // Argumentlarni yuborish
            $arg1 = escapeshellarg(storage_path("app/public/".$filePath)); // Birinchi argument
            // $arg2 = escapeshellarg($request->input('arg2', 'default2')); // Ikkinchi argument

            // Python skriptni ishga tushirish
            // return "python3.9 $scriptPath $arg1 2>&1";
            // $output = shell_exec("python3.9 $scriptPath $arg1 2>&1");
            $output = shell_exec("python $scriptPath $arg1 2>&1");

            // Fayl yo‘lini ajratish
            $info = pathinfo($filePath);

            // Yangi kengaytma bilan fayl yo‘li
            $filePath = $info['dirname'] . '/' . $info['filename'] . '.pdf';
        }

        // Faqat PDF fayllar uchun rasmga aylantirish
        $pageToImages = [];

        if (file_exists(storage_path("app/public/".$filePath))) {

            $pdf = new Pdf(storage_path("app/public/".$filePath));

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

                if(strtolower($file_type) === "pptx"){
                    $angle = 35; // Matn burchagi
                }

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
                "previewPath" => $pageToImages[$pageNumber]
            ]; // Sahifani o‘qish va raqam bilan bog‘lash
        }

        $model = $this->modelClass::create([
            "title" => $request->title ?? $basename,
            "category_id" => $request->category_id ?? null,
            "subject_id" => $request->subject_id ?? null,
            "slug" => Str::slug($basename),
            "path" => $filePath,
            "size" => round(Storage::size("public/".$filePath) / (1024 * 1024), 2)."MB",
            "type" => $extension,
            "responsible_worker" => Auth::user()->name ?? "Not name",
        ]);

        $file = $model->pages()->createMany($allPages);

        return successResponse([
            'message' => 'PDF sahifalari muvaffaqiyatli o‘qildi!',
            'filePath' => $filePath, //http://127.0.0.1:8000/storage/
            'size' => round(Storage::size("public/".$filePath) / (1024 * 1024), 2)."MB",
            'type' => $extension,
            'pages' => $allPages, // Har bir sahifani alohida ko‘rsatish
        ]);
    }


    public function readPdfAndReadWordPagesLocal($data){

        $result = [];
        foreach($data as $item){
            $natija = $this->readPdfAndReadWordPages($item['file'], $item['request']);
            array_push($result, $natija);
        }

        return $result;
    }
}
