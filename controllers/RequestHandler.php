<?php

namespace Controller;

class RequestHandler extends ApiController
{   
    
    public function __construct()
    {
      $this->bot_token = '6200345116:AAHAuwmJ7NftGfghyhkplKEXRBiHaA432NU';
    }
    public function buildKeyboard(int $chat_id)
    {
        $reply_markup = [
            "keyboard" => [["Button 1", "Button 2"], ["Button 3", "Button 4"]],
            "resize_keyboard" => true,
            "one_time_keyboard" => true,
        ];

        $data = [
            "chat_id" => $chat_id,
            "text" => "Choose an option:",
            "reply_markup" => json_encode($reply_markup),
        ];

        return $this->sendResponse(http_build_query($data));
    }
}
