<?php
namespace App\Packages;


class Sms{

    static function send($phone,$message){
        $format = str_replace (["(",")"," ","-","+"],"",$phone);
        $query = http_build_query([
            'login' => 'nya4om',
            'psw' => 'qwerty123',
            'phones' => $format,
            'mes'=> $message
        ]);

        $url = "https://smsc.kz/sys/send.php?".$query;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        $out = curl_exec($curl);
        curl_close($curl);
    }
}
