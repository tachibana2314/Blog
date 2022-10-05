<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $admin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $admin,
        $random_password
    ) {
        $this->admin = $admin;
        $this->random_password = $random_password;
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('【Chateraise】仮登録が完了しました')
            ->view('emails.pre_register')
            ->with(['token' => $this->admin->email_verify_token, 'random_password' => $this->random_password]);
    }
}
