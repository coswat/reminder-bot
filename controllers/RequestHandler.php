<?php

declare(strict_types=1);

namespace Controller;

class RequestHandler extends ApiController
{
    public int $chat_id;
    private $conn;
    public function __construct(int $chat_id)
    {
        $this->chat_id = $chat_id;
        $conn = new Database();
        $this->conn = $conn->connect();
    }
    public function boot()
    {
        $reply_markup = [
            "keyboard" => [["Set Reminder"], ["Current Reminders","Delete Reminders"]],
            "resize_keyboard" => true,
            "one_time_keyboard" => false,
        ];

        $data = [
            "chat_id" => $this->chat_id,
            "text" => "Choose an option:",
            "reply_markup" => json_encode($reply_markup),
        ];

        return $this->sendResponse('sendMessage',http_build_query($data));
    }

    public function handle()
    {
        $reply_markup = [
          "keyboard" => [["Cancel"]],
          "resize_keyboard" => true,
          "one_time_keyboard" => false,
          ];
        $data = [
          'chat_id' => $this->chat_id,
          'text' => 'Write a message to set as reminder
          
Example Message :

i Have a meeting now (2022-04-01 21:45)',
           'reply_markup' => json_encode($reply_markup),
           'parse_mode' => 'html'
          ];
        return $this->sendResponse('sendMessage',http_build_query($data));
    }

    public function remindProccessSet(string $message)
    {
        $this->message = $message;
        if (strpos($this->message, '(') && strpos($this->message, ')')) {
            $time = explode('(', $this->message)[1];
            $time = substr($time, 0, 16);
            $message = str_replace("($time)", '', $this->message);
            $sql = "INSERT INTO `main`(`chat_id`, `time`, `message`) VALUES ($this->chat_id, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$time,$message]);
            $data = [
              'chat_id' => $this->chat_id,
              'text' => 'Reminder set successfully'
              ];
            $this->sendResponse('sendMessage',http_build_query($data));
            return $this->boot();
        }
        $data = [
              'chat_id' => $this->chat_id,
              'text' => 'Bad Format!'
              ];
        return $this->sendResponse('sendMessage',http_build_query($data));
    }

    public function fetchReminders()
    {
        $sql = 'SELECT * FROM main WHERE chat_id='.$this->chat_id.'';
        $stmt = $this->conn->query($sql);
        $reminders = $stmt->fetchAll();
        foreach ($reminders as $reminder) {
            $data = [
                'chat_id' => $this->chat_id,
                'text' => "Reminder : {$reminder->message}
              
Time : {$reminder->time}

ID : {$reminder->id}"
         ];
            $this->sendResponse('sendMessage',http_build_query($data));
        }
        if (!$reminders) {
            $data = [
               'chat_id' => $this->chat_id,
               'text' => 'No Reminders Found!'
               ];
            return $this->sendResponse('sendMessage',http_build_query($data));
        }
    }
   public function deleteRequest()
   {
       $reply_markup = [
           "keyboard" => [["Cancel"]],
           "resize_keyboard" => true,
           "one_time_keyboard" => false,
           ];
       $data = [
         'chat_id' => $this->chat_id,
         'text' => 'Enter ID of Reminder to delete',
         'reply_markup' => json_encode($reply_markup),
         ];
       return $this->sendResponse('sendMessage',http_build_query($data));
   }
   public function deleteReminder(int $id)
   {
       $sql = 'SELECT * FROM main WHERE id=?';
       $stmt = $this->conn->prepare($sql);
       $stmt->execute([$id]);
       $sqlData = $stmt->fetch();
       if ($stmt->rowCount() == 0) {
           $data = [
            'chat_id' => $this->chat_id,
            'text' => "ID {$id} not found!",
            ];
           return $this->sendResponse('sendMessage',http_build_query($data));
       } elseif ($this->chat_id != $sqlData->chat_id) {
           $data = [
            'chat_id' => $this->chat_id,
            'text' => 'Unauthorized',
            ];
           return $this->sendResponse('sendMessage',http_build_query($data));
       } else {
           $sql = 'DELETE FROM main WHERE id=?';
           $stmt = $this->conn->prepare($sql);
           $stmt->execute([$id]);
           $data = [
            'chat_id' => $this->chat_id,
            'text' => "Reminder deleted successfully",
            ];
           $this->sendResponse('sendMessage',http_build_query($data));
           return $this->boot();
       }
   }
}
