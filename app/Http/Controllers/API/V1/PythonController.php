<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PythonController extends Controller
{
    public function runPythonScript(Request $request)
    {
        $scriptPath = app_path('app/scripts/script.py');
        
        // Argumentlarni yuborish
        $arg1 = escapeshellarg($request->input('arg1', storage_path('app\public\uploads\1736510473\1736510473-garant.pptx'))); // Birinchi argument
        // $arg2 = escapeshellarg($request->input('arg2', 'default2')); // Ikkinchi argument

        // Python skriptni ishga tushirish
        $output = shell_exec("python $scriptPath $arg1 2>&1");

        return response()->json([
            'message' => 'Python script executed',
            'output' => json_encode($output),
        ]);
    }
}
