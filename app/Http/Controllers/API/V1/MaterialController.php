<?php

namespace App\Http\Controllers\API\V1;

use App\DTO\MaterialDTO;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Subject;
use App\Services\FileService;
use App\Services\MaterialCRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    protected $serviceClass;
    protected $classDTO;

    public function __construct()
    {
        $this->serviceClass = new MaterialCRUDService();
        $this->classDTO = new MaterialDTO();
    }

    public function index(){

        return $this->serviceClass->index();

    }

    public function forOptions(){

        return $this->serviceClass->forOptions();

    }


    public function view(string $id){

        return $this->serviceClass->view($id);
    }

    public function store(){


        $data = $this->classDTO->fromRequest([
            "title" => request()->title,
            "slug" => createUniqueSlug(request()->title, Material::class),
            "downloads" => request()->downloads,
            "category_id" => request()->category_id,
            "subject_id" => request()->subject_id,
            "path" => request()->path,
            "size" => request()->size,
            "type" => request()->type,
            "responsible_worker" => Auth::user()->name ?? "Not name",
        ]);
        
        if(is_array($data))
            return $data;

        return $this->serviceClass->store($data->toArray());
       
    }

    public function update(string $id){

        $data = $this->classDTO->fromRequest([
            "title" => request()->title,
            "slug" => createUniqueSlug(request()->title, Material::class),
            "downloads" => request()->downloads,
            "category_id" => request()->category_id,
            "subject_id" => request()->subject_id,
            "path" => request()->path,
            "size" => request()->size,
            "type" => request()->type,
            "responsible_worker" => Auth::user()->name ?? "Not name",
        ]);
        
        if(is_array($data))
            return $data;

        return $this->serviceClass->update($id, $data->toArray());
    }

   
    public function destroy(string $id){

        return $this->serviceClass->destroy($id);
    }


    public function readPdfAndReadWordPages(Request $request){

        // Validayatsiya

        $validate = validate($request->all(), [
            'title' => "required",
            'category_id' => "required",
            'subject_id' => "required",
            'file' => 'required|mimes:pdf,docx,doc,pptx,ppt,zip|max:20480', // Faqat PDF,PPT,DOC fayllar uchun
        ]);
    
        if ($validate !== true) return $validate;
        
        // Faylni yuklash
        $file = request()->file('file');

        return $this->serviceClass->readPdfAndReadWordPages($file, $request);
       
    }


    public function readPdfAndReadWordPagesLocalUploads()
    {   

        $basePath = 'D:\Arxiv.uz\diplom-ishlar\zoologiya\\';
        $files = File::allFiles($basePath);
        $filenames = [];
        foreach ($files as $file) {
            $relativePath = str_replace($basePath, '', $file->getPathname());
            $filenames[] = $relativePath;
        }


        $local_data = [];
        foreach($filenames as $filename){
            
            $filePath = $basePath.$filename; // Faylning to‘liq yo‘li
            // dd(basename(dirname($filename)));
            
            if (!file_exists($filePath)) {
                continue;
            }

            // Fake UploadedFile yaratish
            $file = new UploadedFile(
                $filePath,
                basename($filePath),
                mime_content_type($filePath),
                null,
                true // $test = true, ya'ni bu test fayl ekanligini bildiradi
            );

            // $subject = Subject::where('slug', basename(dirname($filename)))->first();
            // Fake request yaratish va faylni qo‘shish
            $request = new Request();
            $request->files->set('file', $file);
            $request->merge([
                'title' => Str::headline(pathinfo($filename, PATHINFO_FILENAME)),
                'category_id' => 2,
                'subject_id' => 66,
            ]);
            
            // Validayatsiya
            // $validate = validator($request->all(), [
            //     'title' => "required",
            //     'category_id' => "required",
            //     'subject_id' => "required",
            //     'file' => 'required|mimes:pdf,docx,doc,pptx,ppt,zip|max:504800', // Faqat PDF, PPT, DOC, ZIP fayllar uchun
            // ]);
            
            // if ($validate !== true) {
            //     continue;
            // }
    
            
            // Faylni olish
            $file_alohida = $request->file('file');
            array_push($local_data, [
                "file" => $file_alohida,
                "request" => $request
            ]);
        
        }
        
        $result = $this->serviceClass->readPdfAndReadWordPagesLocal($local_data);
        return response()->json($result);


    }


    // public function deleteFiles(Request $request)
    // {
    //     $extension = $request->input('extension', 'pptx'); // default txt
    //     $directory = storage_path('app/public/uploads');

    //     $message = FileService::deleteFilesByExtension($directory, $extension);
    //     return response()->json(['message' => $message]);
    // }

    // public function deleteFilesPageImages(Request $request)
    // {

    //     $folders = Storage::disk('public')->directories('uploads'); // 'storage/app/public/test' ichidagi barcha papkalarni olish
        
    //     foreach ($folders as $folder) {
    //         $files = Storage::disk('public')->files($folder);
    //         foreach ($files as $file) {
    //             // Faqat "page-{raqam}.jpg" formatidagi fayllarni o‘chirish
    //             if (preg_match('/page-\d+\.jpg$/', basename($file))) {
    //                 Storage::disk('public')->delete($file);
    //             }
    //         }
    //     }

    //     echo "Faqat 'page-{raqam}.jpg' shaklidagi rasmlar o‘chirildi.";


    // }
}
