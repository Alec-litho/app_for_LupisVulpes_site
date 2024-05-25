<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Drive;


class AnimationController extends Controller
{
    public function getAnimation(Request $request) 
    {

        $client = new Client();
        $client->setAuthConfig(config("globalVariables.oauthCredentials"));
        $client->setRedirectUri("globalVariables.redirect_uri");
        $client->addScope("https://www.googleapis.com/auth/drive");
        $client->setDeveloperKey("AIzaSyDwGHNFrK7J1VyKrr4iKKUhUy-KuiOi3Js");

        $token = $client->fetchAccessTokenWithAuthCode($request->accessToken);
        $client->setAccessToken($token);

        $service = new Drive($client);

        $result = $service->files->get("12Y5yaVCvTmUL8UsNIqDKQT_Vsk1W12pd");
        
        
    }
}



