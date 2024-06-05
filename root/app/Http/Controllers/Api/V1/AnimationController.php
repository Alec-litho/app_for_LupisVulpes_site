<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Root\Config\AuthorizeGoogleService;
use Google\Service\Drive\DriveFile;
use Google\Http\MediaFileUpload;
use \Google_Service_Drive_DriveFile;
use GuzzleHttp\Psr7\Request as Req;
class AnimationController extends Controller
{
    public function getAnimation(Request $request, Response $response, string $id, AuthorizeGoogleService $AuthorizedGoogleService) 
    {   $authorizedGoogleService = new AuthorizeGoogleService();
        $service = $authorizedGoogleService->createService();
        $response = $service->files->get($id, array('alt' => 'media'));
        dd($response);
        
    }
    public function uploadAnimation(Request $req, AuthorizeGoogleService $AuthorizeGoogleService) 
    {   
        
        $target_file=$_FILES["fileToUpload"];

        $authorizedGoogleService = new AuthorizeGoogleService();
        $service = $authorizedGoogleService->createService();
        $response = $authorizedGoogleService->authorizeClient();
        $client = $response["client"];
        $requestData = $client->getHttpClient();
        $file = new DriveFile();
        $file->setName($target_file["name"]);
        $file->parents = array("19siSP9hSbuEtQQh8BFCgUj2Go_h5iF2x");
        $chunkSizeBytes = 1 * 1024 * 1024;
        $request = $service->files->create($file);
        $media = new \Google_Http_MediaFileUpload(
            $client,
            $request,
            $target_file["type"],
            null,
            true,
            $chunkSizeBytes
        );
        $media->setFileSize($target_file["size"]);
    
        function readVideoChunk($handle, $chunkSize)
    {
        $byteCount = 0;
        $giantChunk = "";
        while (!feof($handle)) {
            // fread will never return more than 8192 bytes if the stream is read
            // buffered and it does not represent a plain file
            $chunk = fread($handle, 8192);
            $byteCount += strlen($chunk);
            $giantChunk .= $chunk;
            if ($byteCount >= $chunkSize) {
                return $giantChunk;
            }
        }
        return $giantChunk;
    }
        $status = false;
        $handle = fopen($target_file["tmp_name"], "rb");
        while (!$status && !feof($handle)) {
            $chunk = readVideoChunk($handle, $chunkSizeBytes);
            $status = $media->nextChunk($chunk);
        }

        dd($status);
        fclose($handle);
    
    
        //https://drive.google.com/file/d/1108CDJT8VgSxkLdidrwKL1eVom38rSer/view
    }
}


