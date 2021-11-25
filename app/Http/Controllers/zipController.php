<?php

namespace App\Http\Controllers;

use File;
use Storage;

use ZipArchive;
use App\Http\Requests;

use Illuminate\Http\Request;

use Illuminate\Filesystem\Filesystem;
use App\Contracts\ZipServiceInterface;

class zipController extends Controller
{
    // ZipServiceInterface $zipservice
    public function zipFile()
    {
      
           
     
            // Zip File Name
            $zipFileName = 'AllQRCode.zip';
            // Create ZipArchive Obj
            $zip = new ZipArchive;
            if ($zip->open( public_path('storage/zipfile/'.$zipFileName), ZipArchive::CREATE) === TRUE) {
                // Add Multiple file   
                $files= File::files(public_path('storage/images'));
                
                //dd($files);
                foreach ($files as $key => $value) {
                    $relativeNameInZipFile = basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
                $zip->close();
            }
            $file = new Filesystem;
            $file->cleanDirectory(base_path('public\storage\images\\'));
         
        //     // Set Header
            $headers = array(
                'Content-Type' => 'application/octet-stream',
            );
        $filetopath = public_path('storage/zipfile/'.$zipFileName);
             // Create Download Response
            if (file_exists($filetopath)) {
               return response()->download($filetopath, $zipFileName, $headers);
             }

  
     }
}

