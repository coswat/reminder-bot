<?php

namespace Controller;

class ApiController
{
    protected string $bot_token = '6200345116:AAElKFj_tDJXm-LQPagLQ1xKLNfJfMOShZU';

    public function sendResponse(string $data)
    {
        $url = "https://api.telegram.org/bot{$this->bot_token}/sendMessage?{$data}";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($curl);
        curl_close($curl);
    }
}
