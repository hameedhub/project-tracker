<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadsController extends Controller
{
    public function material($file_name) {
        $file_path = public_path('storage/materials/'.$file_name);
        return response()->download($file_path);
      }
      public function assessment($file_name) {
        $file_path = public_path('storage/assessments/'.$file_name);
        return response()->download($file_path);
      }
}
