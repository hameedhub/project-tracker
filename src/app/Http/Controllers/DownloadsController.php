<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadsController extends Controller
{
    public function download($file_name) {
        $file_path = public_path('storage/materials/'.$file_name);
        return response()->download($file_path);
      }
}
