<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes 1

$app->post('/[{name}]', function (Request $request, Response $response, array $args) {

        $token = '648589176:AAH_lZlA5DtO5TSTcsYvlXTwRsxbHKkEBT8';

        $bot = new \TelegramBot\Api\Client($token);

        $bot->command('start', function ($message) use ($bot) {

            function CallAPI($method, $api, $data=null) {
                $url = "http://api.oboobs.ru/boobs/500/1/random/" . $api;
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                $response = curl_exec($curl);
                $data = json_decode($response, true);
                return $data;
            }

            $result = CallAPI('POST', "");
            $url = 'http://media.oboobs.ru/' . $result[0]['preview'];
            $answer = 'Добро пожаловать!';
            $bot->sendPhoto($message->getChat()->getId(), $url);
        });

        $bot->command('help', function ($message) use ($bot) {
            $answer = 'Команды:/help - вывод справки';
            $bot->sendMessage($message->getChat()->getId(), $answer);
        });

        $bot->run();
});

