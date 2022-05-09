<?php

namespace App\Mail;

use App\Models\Tte;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailQrCode extends Mailable
{
  use Queueable, SerializesModels;

  public $tte;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(Tte $tte)
  {
    $this->tte = $tte;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $tte = $this->tte;
    
    // dd(public_path() . '/storage' . $tte->tte);

    return $this->subject('Tanda Tangan Elektronik')->attach(public_path() . '/storage' . $tte->tte)->view('email.email-qrcode', compact('tte'));
  }
}
