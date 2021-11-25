<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use ZipArchive;



class QrCodeController extends Controller
{

  /**
   * success response method.
   *
   * @return \Illuminate\Http\Response
   */
  
  public function generateQrCode(Request $request)

  { $oldFile = new Filesystem;
    $oldFile->cleanDirectory(base_path('public\storage\images\\'));
    info($request->file->get('files'));
    $current = $request->file->get('files');
    $strs = explode(" ", $current);
    foreach ($strs as $str) {
      \QrCode::size(500)
        ->format('png')
        ->generate($str, public_path("storage/images/" . $str . ".png"));
      };
      $oldzip = new Filesystem;
      $oldzip->cleanDirectory(base_path('public\storage\zipfile\\'));
      return response()->json(['success' => 'You have successfully upload file and U had each string a QrCode Press Downloand']);
    
  }
  
  public function zipFile()
  {

    $zipFileName = 'AllQRCode.zip';
    $zip = new ZipArchive;
    if ($zip->open(public_path('storage/zipfile/' . $zipFileName), ZipArchive::CREATE) === TRUE) {
      $files = File::files(public_path('storage/images'));
      foreach ($files as $key => $value) {
        $relativeNameInZipFile = basename($value);
        $zip->addFile($value, $relativeNameInZipFile);
      }
      $zip->close();
    }
    $file = new Filesystem;
    $file->cleanDirectory(base_path('public\storage\images\\'));
    $headers = array(
      'Content-Type' => 'application/octet-stream',
    );
    $filetopath = public_path('storage/zipfile/' . $zipFileName);
    // Create Download Response
    if (file_exists($filetopath)) {
      return response()->download($filetopath, $zipFileName, $headers);
    }
  }
}
