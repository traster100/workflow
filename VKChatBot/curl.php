<?php

class Curl
{

    public static function getpage($url, $head = 0, $body = 1, $verbose = 0)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt(
            $curl,
            CURLOPT_USERAGENT,
            'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.114 Safari/537.36'
        );
        curl_setopt(
            $curl,
            CURLOPT_RETURNTRANSFER,
            1
        );
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_FAILONERROR, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        if ($head == 1) {
            curl_setopt($curl, CURLOPT_HEADER, 1);
        }
        if ($body == 0) {
            curl_setopt($curl, CURLOPT_NOBODY, 1);
        }
        if ($verbose == 1) {
            curl_setopt($curl, CURLOPT_VERBOSE, 1);
        }
        $content = curl_exec($curl);
        curl_close($curl);

        if ($content === false) {
            return false;
        } else {
            return $content;
        }
    }
}