<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailCreatingUserAccountSuccess extends Mailable
{
  use Queueable, SerializesModels;

  public $email;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($email)
  {
    $this->email = $email;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $user = User::where('email', $this->email)->first();

    return $this->subject('Pembuatan Akun')->view('email.email-creating-success', compact('user'));
  }
}
