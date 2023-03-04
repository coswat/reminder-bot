<?php

namespace Controller;

class RequestHandler extends ApiController
{
    public function boot(int $chat_id)
    {
        $reply_markup = [
            "keyboard" => [["Set Reminder"], ["Current Reminders","Contact Us"]],
            "resize_keyboard" => true,
            "one_time_keyboard" => false,
        ];

        $data = [
            "chat_id" => $chat_id,
            "text" => "Choose an option:",
            "reply_markup" => json_encode($reply_markup),
        ];

        return $this->sendResponse(http_build_query($data));
    }
}
