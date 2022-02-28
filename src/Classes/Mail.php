<?php

namespace App\Classes;

use Mailjet\Client;
use Mailjet\Resources;
use Symfony\Component\Dotenv\Dotenv;
class Mail
{
    public function __construct() 
    {
        (new Dotenv())->bootEnv(dirname(__DIR__) . '/../.env');
        $this->mailjet_api_key = $_ENV['MJ_APIKEY_PUBLIC'];
        $this->mailjet_api_key_secret = $_ENV['MJ_APIKEY_PRIVATE'];
    }

    public function send($to_mail, $to_user, $subject, $content)
    {
        $mj = new Client($this->mailjet_api_key, $this->mailjet_api_key_secret, true, ['version' => 'v3.1']);
        //$mj = new Client(getenv('MJ_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'),true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "webtestprojet@gmail.com",
                        'Name' => "Boucherie Benoit Paux"
                    ],
                    'To' => [
                        [
                        'Email' => $to_mail,
                        'Name' => $to_user
                        ]
                    ],
                    'TemplateID' => 3640490,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }
}

