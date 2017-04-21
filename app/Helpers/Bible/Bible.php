<?php

namespace App\Helpers\Bible;

class BibleHelper
{
    public static function getRandomVerse()
    {
        // random bible verse
        $url = 'http://labs.bible.org/api/?passage=random';

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 240);
        $result = curl_exec($ch);
        curl_close($ch);

        preg_match_all('/<b>(.*?)<\/b>/s', $result, $matches);
        $book = $matches[1][0];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://bible-api.com/' . urlencode($book));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $response = json_decode($response, true);

        return $response;
    }
}