<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExampleEmail; // Make sure to create a Mailable

class EmailController extends Controller
{
    public function sendEmail()
    {
        // Logic to send emails using the Mail facade
        Mail::to('recipient@example.com')->send(new ExampleEmail());

        return 'Email sent successfully!';
    }

    public function create()
    {
       return view('mailbox.compose');
    }

    public function index()
    {
       return view('mailbox.read-mail');
    }

    public function mailbox()
    {
       return view('mailbox.mailbox');
    }
}
