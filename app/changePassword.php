<?php

namespace App;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class changePassword extends Mailable
{

    public $distressCall;

    use Queueable, SerializesModels;


    public $name;
    public $pin;
    public $lastName;


    public function __construct($name,$lastName,$pin)
    {
        $this->name = $name;
        $this->pin = $pin;
        $this->lastName = $lastName;
    }
    public function build()
    {
        return $this->subject("Reestablecer contraseña")->view('resetPassword');
    }
}
