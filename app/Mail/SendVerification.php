<?php

namespace App\Mail;


use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerification extends Mailable
{
  use Queueable, SerializesModels;
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public $user;

  public function __construct(User $user)
  {
    return $this->user = $user;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->markdown('auth.emails.verification')->subject('Verifikasi Akun Perpustakaan');
  }
}
