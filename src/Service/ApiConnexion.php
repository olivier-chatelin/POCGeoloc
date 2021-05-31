<?php


namespace App\Service;


use Symfony\Component\HttpClient\HttpClient;

class ApiConnexion
{
     const URLREQUESTCITYNAME = 'https://geo.api.gouv.fr/communes?fields=nom,centre&format=json&geometry=centre';
    public function getCityName(int $postalCode): array
    {
        $client = HttpClient::create();
        $response = $client->request('GET',self::URLREQUESTCITYNAME . '&codePostal=' . $postalCode);
        $content = $response->toArray();
        return $content[0];
    }

}