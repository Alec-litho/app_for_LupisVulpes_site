<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Root\Config\AuthorizeGoogleService;
use Google\Service\Drive\DriveFile; 
use Google\Service\Drive; 
use \Illuminate\Support\Facades\Validator;
use App\Models\Animation;
use Google\Client;

// use Google\Http\MediaFileUpload;
// use \Google_Service_Drive_DriveFile;
// use GuzzleHttp\Psr7\Request as Req;
class AnimationController extends Controller
{
    public AuthorizeGoogleService $authorizedGoogleService;
    public Client $client;
    public Drive $service;

    public function __construct() {
        $this->authorizedGoogleService = new AuthorizeGoogleService();
        $this->client = $this->authorizedGoogleService->authorizeClient()["client"];
        $this->service = $this->authorizedGoogleService->createService();

    }
    public function getAnimation(Request $request, Response $response, string $id, AuthorizeGoogleService $AuthorizedGoogleService) 
    {   $authorizedGoogleService = new AuthorizeGoogleService();
        $service = $authorizedGoogleService->createService();
        $response = $service->files->get($id, array('alt' => 'media'));
        dd($response);
        
    }
    public function uploadAnimationToDrive(Request $req, Response $res/*,AuthorizeGoogleService $AuthorizeGoogleService*/) 
    {   
        $target_file=$_FILES["fileToUpload"];
        $file = new DriveFile();
        $file->setName($target_file["name"]);
        $file->parents = array(config("globalVariables.parentFolder"));
        $chunkSizeBytes = 1 * 1024 * 1024;
        $request = $this->service->files->create($file);
        $media = new \Google_Http_MediaFileUpload(
            $this->client,
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
        fclose($handle);
        return json_encode($status);
    }

    function uploadAnimationToDB(Request $req) {
        $body = $req->all();
        $validator = Validator::make($req->all(), [
            "animationLink" => ["required", "string"],
            "previewLink" => ["required", "string"],
            "year" => ["required", "string"],
            "characters" => ["required", "string"],
            "fandom" => ["required", "string"],
            "show" => ["required", "string"],
            "isCommission" => ["required", "string"]
        ]);
        if($validator->fails()) {
            $deletingResult = $this->deleteAnimationFromDrive($body["animationLink"]);
            dd($deletingResult);
            // return redirect()->route('/animations')->withErrors($validator);
        } else {
            try {
                settype($body['isCommission'], 'bool');
                $animationModel = Animation::create($body);
                $animationModel->save();
                return redirect()->route('/animations');
            } catch (\Exception $exc) {
                echo $exc->getMessage();
            };

        }
    }

    function deleteAnimationFromDrive($link) {
        return $this->service->files->delete($link, array('supportsAllDrives' => true));
    }
}


