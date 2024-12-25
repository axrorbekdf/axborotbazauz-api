<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class TelegramReport
{
    protected $http;
    const base_url = 'https://api.telegram.org/bot';

    public function __construct(Http $http)
    {
        $this->http = $http;
    }

    public function sendMessage($chat_id, $message,)
    {
        return $this->http::post(self::base_url . env('TELEGRAM_TOKEN') . '/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html'
        ]);
    }
}
