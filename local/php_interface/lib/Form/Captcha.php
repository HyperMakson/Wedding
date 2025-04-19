<?php
namespace lib\Form;

class Captcha
{
    public function checkCaptcha(string $secretKey = "", string $token = ""): bool
    {
        if (empty($secretKey) || empty($token)) {
            return false;
        }

        $ch = curl_init("https://www.google.com/recaptcha/api/siteverify");
        curl_setopt_array(
            $ch,
            [
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => [
                    "secret" => $secretKey,
                    "response" => $token,
                    "remoteip" => $_SERVER['REMOTE_ADDR'],
                ],
            ]
        );

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        if ($result['success'] && $result['score'] >= 0.5) {
            return true;
        }

        return false;
    }
}