<?php

namespace App\Helpers;

class SMS
{
  public static function sendMessage(string $phone_number, string $message)
  {
    $data = [
      'api_id'      => config('sms.api_id'),
      'api_password'=> config('sms.api_password'),
      'encoding'    => 'T',
      'sms_type'    => 'T',
      'sender_id'   => config('sms.sender_id'),
      'phonenumber' => $phone_number,
      'textmessage' => $message,
    ];
    $headers = ['Content-Type: application/json', 'Accept: application/json'];
    $fields_string = json_encode($data);
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, config('sms.sms_service_provider_url'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    // error_log($result);
    return $result;
  }
}
