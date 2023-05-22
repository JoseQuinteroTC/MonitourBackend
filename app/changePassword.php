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


    public $nombre;
    public $pin;


    public function __construct($nombre,$pin)
    {
        $this->nombre = $nombre;
        $this->pin = $pin;
    }
    public function build()
    {
        return $this->view('resetPassword');
    }
}
