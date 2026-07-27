<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SendGridService;

class TestEmailController extends Controller
{
    public function sendTest()
    {
        $to = "ntiruhungwab@gmail.com";
        $name = "User";
        $subject = "Test Email from Laravel + SendGrid";
        $body = "<p>Hello, this is a test email sent via SendGrid API.</p>";

        $response = SendGridService::sendEmail($to, $name, $subject, $body);

        dd($response);
    }
}
