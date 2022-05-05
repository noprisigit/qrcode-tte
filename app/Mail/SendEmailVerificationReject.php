<?php

namespace App\Mail;

use App\Models\VerifikasiPegawai;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailVerificationReject extends Mailable
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
    $email = $this->email;
    $verifikasi_pegawai = VerifikasiPegawai::where('value', $email)->first();
    $data = VerifikasiPegawai::where('identity_number', $verifikasi_pegawai->identity_number)
      ->where('name', 'nama')
      ->first();

    return $this->view('email.email-verification-reject', compact('data'));
  }
}
