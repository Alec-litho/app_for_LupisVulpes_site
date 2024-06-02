<?php

namespace Root\Config;

use Google\Client;
use Google\Service\Drive;

class AuthorizeGoogleService
{   

    public function authorizeClient(): Client {
        $client = self::setInitial();
        $token = self::getAccessToken($client);
        $client->setAccessToken($token);
        return $client;
    }

    public function createService(): Drive
    {
        $client = $this->authorizeClient();
        $shit = new Google_DriveService();
        $service = new Drive($client);
        return $service;
    }

    public static function setInitial(): Client
    {
        $client = new Client();
        $client->setApplicationName("globalVariables.websiteName");
        $client->setAuthConfig(config("globalVariables.oauthCredentials"));
        $client->setRedirectUri(config("globalVariables.redirect_uri"));
        $client->addScope("https://www.googleapis.com/auth/drive");
        $client->setDeveloperKey(config("globalVariables.developer_key"));
        $client->setAccessType('offline');
        $client->setPrompt("consent");
        $client->setIncludeGrantedScopes(true);   // incremental auth
        $client->setApprovalPrompt('force');
        return $client;
    }
    public static function getAccessToken(Client $client):string {
        $accessToken = $client->fetchAccessTokenWithRefreshToken(config("globalVariables.refresh_token"));
        return $accessToken["access_token"];
    }

}