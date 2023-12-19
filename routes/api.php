<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


Route::match(['GET', 'POST'], '/', function (Request $request) {
    $telegramBotToken = config('app.tg_bot');

    $content = file_get_contents("php://input");
    $update = json_decode($content, true);
    Log::alert($update);
    if (isset($update['message'])) {
        $message = $update['message'];
        $chat_id = $message['chat']['id'];
        $text = $message['text'];
        if ($text == '/start') {
            $response = 'Merhaba! Botunuz çalışıyor.';
            file_get_contents("https://api.telegram.org/bot$telegramBotToken/sendMessage?chat_id=$chat_id&text=$response");
        }
    }
});
