<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
    public function send() {
        Mail::send(['text' => 'mail'], ['name'=>'KAMPDAS'], function ($message){
            $message->to('ogarip16@gmail.com', 'Omer Garip')->subject('uyelik hakkinda');
            $message->from('bilgi@kampdas.org', 'KAMPDAS');
        });
    }
}
