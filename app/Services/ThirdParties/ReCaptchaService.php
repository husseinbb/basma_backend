<?php

namespace App\Services\ThirdParties;

use GuzzleHttp;
use GuzzleHttp\Client;

class ReCaptchaService
{
    public function verifyReCaptcha($data)
    {
        $data['secret'] = config('keys.recaptcha.secret_key');
        $client = new GuzzleHttp\Client();
        $res = $client->post('https://www.google.com/recaptcha/api/siteverify', $data);
        return json_decode($res->getBody());
    }
}