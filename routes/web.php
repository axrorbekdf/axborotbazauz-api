<?php

use Illuminate\Support\Facades\Route;
use App\Services\FileUpload\FileManager;
use App\Services\FileUpload\Uploaders\PdfUploader;
use App\Services\FileUpload\Uploaders\DocUploader;
use App\Services\FileUpload\Uploaders\PptUploader;
use App\Services\FileUpload\Converters\DocToPdfConverter;
use App\Services\FileUpload\Converters\PptToDocAndPdfConverter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::post('/upload/test', function () {
    return "OK0";
    // $file = request()->file('file');
    // $extension = $file->getClientOriginalExtension();

    // try {
    //     if ($extension === 'pdf') {
    //         $manager = new FileManager(new PdfUploader());
    //     } elseif (in_array($extension, ['doc', 'docx'])) {
    //         $manager = new FileManager(new DocUploader(), new DocToPdfConverter());
    //     } elseif (in_array($extension, ['ppt', 'pptx'])) {
    //         $manager = new FileManager(new PptUploader(), new PptToDocAndPdfConverter());
    //     } else {
    //         throw new Exception("Unsupported file type.");
    //     }

    //     $resultPath = $manager->processFile($file);
    //     return response()->json(['message' => 'File processed successfully!', 'path' => $resultPath]);
    // } catch (\Exception $e) {
    //     return response()->json(['error' => $e->getMessage()], 400);
    // }
});