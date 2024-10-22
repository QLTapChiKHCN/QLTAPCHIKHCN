<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiViet;
class APIGETBAIVIETCotroller extends Controller
{

     public function getFiles()
     {
         $baiViets = BaiViet::select('MaBaiBao', 'TenBaiBao', 'FileBaiViet')->get();
         return response()->json($baiViets);
     }


     public function downloadFile($id)
     {
         $baiViet = BaiViet::where('MaBaiBao', $id)->first();
         if ($baiViet && $baiViet->FileBaiViet) {
             $filePath = public_path('public/storage/uploads/' . $baiViet->FileBaiViet);
             if (file_exists($filePath)) {
                 return response()->download($filePath);
             }
             return response()->json(['error' => 'File không tồn tại'], 404);
         }
         return response()->json(['error' => 'Bài viết không tồn tại'], 404);
     }
}
