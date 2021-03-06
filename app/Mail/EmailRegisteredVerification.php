<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class EmailRegisteredVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $member, $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $member, $password)
    {
        $this->member = $member;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('auth.emails.invite')->subject('Email anda telah di daftarkan');
    }
}
