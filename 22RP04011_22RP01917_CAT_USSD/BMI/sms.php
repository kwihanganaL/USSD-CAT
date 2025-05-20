<?php
require 'vendor/autoload.php';

use AfricasTalking\SDK\AfricasTalking;

class Sms {
    protected $phone;
    protected $AT;

    function __construct($phone) {
        $this->phone = $phone;

        
        $apiKey = trim("atsk_f4d53cd4b4562503487f2ed348c16f8729eee2467352f0e01977ec2d3b8e778a4bce20b5");
        $this->AT = new AfricasTalking("sandbox", $apiKey);
    }

    public function sendSMS($message, $recipients) {
        // Get the SMS service
        $sms = $this->AT->sms();

        // Send the message
        $result = $sms->send([
            'username' => "sandbox",
            'to'       => $recipients,
            'message'  => $message,
            'from'     => "bmi"
        ]);

        return $result;
    }
}
