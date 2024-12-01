<?php
namespace App\Entity;
use Mailjet\Client;
use Mailjet\Resources;
use Symfony\Component\Dotenv\Dotenv;

class Mail
    {
        private $api_key="03e4ef9f98e31ae13a5943bd39511f4b";
        private $api_key_secret="b6379a2d457a9b32b76d16929a8ba880";
/* public function __construct()
{
(new Dotenv())->bootEnv(dirname(__DIR__) . '/../.env');
$this->api_key = $_ENV['API_KEY'];
$this->api_key_secret = $_ENV['API_KEY_SECRET'];
} */
public function send($to_email, $to_name, $subject, $content){

    $mj = new Client($this->api_key, $this->api_key_secret, true, ['version'=> 'v3.1']);
    $body = [
        'Messages' => [
        [
            'From' => [
                'Email' => "saadamaryem112@gmail.com",
                'Name' => "AFCS"
            ],
            'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]   
            ],
            'TemplateID' => 6467148,
            'TemplateLanguage' => true,
            'Subject' => $subject,
            'Variables' => ['content' => $content]
        ]
        ]
    ]
;

$response = $mj->post(Resources::$Email, ['body' => $body]);
$response->success();
}
}