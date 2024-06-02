<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Root\Config\AuthorizeGoogleService;
use Google\Service\Drive\DriveFile;
use Google\Http\MediaFileUpload;
use \Google_Service_Drive_DriveFile;
use Psr\Http\Message\RequestInterface;

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
        // $reqBody = $req->getContent();
        $service = $authorizedGoogleService->createService();
        $client = $authorizedGoogleService->authorizeClient();
        $fileMetadata = new DriveFile();
        $fileMetadata->setName($target_file["name"]);
        // $fileMetadata->setParents(["Animations"]);
        $chunkSizeBytes = 1 * 1024 * 1024;
        $client->setDefer(true);

        $request = $service->files->create($fileMetadata);
        
        $media = new \Google_Http_MediaFileUpload(
            $client,
            $request,
            'text/plain',
            null,
            true,
            $chunkSizeBytes
        );
        $media->setFileSize(filesize($target_file));
    

        $status = false;
        $handle = fopen($target_file, "rb");
        while (!$status && !feof($handle)) {
            $chunk = readVideoChunk($handle, $chunkSizeBytes);
            $status = $media->nextChunk($chunk);
        }

        $result = false;
        if ($status != false) {
            $result = $status;
            dd("я ебал эту кантогору пидорасов");
        }
    
        fclose($handle);
    
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


    }
}


