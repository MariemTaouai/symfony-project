<?php

// Import necessary namespaces
use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = "0964f327e210e4e5715c797a277caeb6";
    private $api_key_secret = "6beb43b09dba00103ab2d5591235c546";

    // Constructor to load environment variables (optional)
    /* public function __construct()
    {
        (new Dotenv())->bootEnv(dirname(__DIR__) . '/../.env');
        $this->api_key = $_ENV['API_KEY'];
        $this->api_key_secret = $_ENV['API_KEY_SECRET'];
    } */

    public function send($to_email, $to_name, $subject, $content)
    {
        // Create a Mailjet client instance
        $mj = new Client($this->api_key, $this->api_key_secret, true, ['version' => 'v3.1']);

        // Define the message body
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "mfaouzi.hmida@gmail.com",
                        'Name' => "AFCS"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 4208231,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content
                    ]
                ]
            ]
        ];

        // Send the email via Mailjet API
        $response = $mj->post(Resources::$Email, ['body' => $body]);

        // Check if the request was successful
        if ($response->success()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
