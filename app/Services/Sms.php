<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Sms
{

    public static function send(string $phone, string $message): void
    {
      $res = Http::withoutVerifying()->get('https://smsc.kz/sys/send.php', [
            'login' => 'Darkhanbeks@gmail.com',
            'psw' => 'sR!3q!pambh8Gu8',
            'phones' => $phone,
            'mes' => $message,
        ]);
    }
}
