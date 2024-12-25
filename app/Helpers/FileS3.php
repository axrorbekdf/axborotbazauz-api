<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class FileS3
{
    static public function store($disk, $path, $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_path = Carbon::now()->format('d-m-Y');
            $filePath = $path . '/' . (string)$file_path . '/' . time() . uniqid() . '-' . $file->getClientOriginalName();

            // Upload file to the specified disk (s3 in this case)
            Storage::disk($disk)->put($filePath, file_get_contents($file));

            // Get the file URL
            $fileUrl = Storage::disk($disk)->url($filePath);

            $corrected_url = str_replace('\\', '/', urldecode($fileUrl));

            return successResponse($corrected_url);
        }

        return errorResponse('No file provided!');
    }

    static public function delete($disk, $file)
    {
        $file_path = explode("garantclient/", $file)[1];

        if (Storage::disk($disk)->exists($file_path)) {
            Storage::disk($disk)->delete($file_path);

            return successResponse("Deleted successfuly!");
        } else {
            return errorResponse('File not found!');
        }
    }
}
