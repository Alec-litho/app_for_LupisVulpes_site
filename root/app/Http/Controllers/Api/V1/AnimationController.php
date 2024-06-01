<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Root\Config\AuthorizeGoogleService;
use Google\Service\Drive\DriveFile;
use Google\Http\MediaFileUpload;
use Psr\Http\Message\RequestInterface;
class AnimationController extends Controller
{
    public function getAnimation(Request $request, Response $response, string $id, AuthorizeGoogleService $AuthorizedGoogleService) 
    {   $authorizedGoogleService = new AuthorizeGoogleService();
        $service = $authorizedGoogleService->createService();
        $response = $service->files->get($id, array('alt' => 'media'));
        dd($response);
        
    }
    public function loadAnimation(Request $req, AuthorizeGoogleService $AuthorizeGoogleService) 
    {   
        $target_file=$_FILES["fileToUpload"]["name"];

        $authorizedGoogleService = new AuthorizeGoogleService();
        $reqBody = $req->getContent();
        $service = $authorizedGoogleService->createService();
        $client = $authorizedGoogleService->client;
        $file = new DriveFile();
        $file->name = $reqBody["animationName"];
        $chunkSizeBytes = 1 * 1024 * 1024;
        $client->setDefer(true);

        $request = $service->files->create($file);
    

        $media = new MediaFileUpload(
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


        $service->files->create();

    }
}

//https://www.googleapis.com/drive/v3/files/1jflkMkI7nZzbBh6nzRzq_BZvf8leqW2o?alt=media&key=AIzaSyA0LLKMTZS6Y5QJtv3pa1FIkSfW0pqDKdQ&supportsAllDrives=true

