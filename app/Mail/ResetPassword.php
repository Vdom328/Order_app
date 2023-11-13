<?php

// app/Mail/ResetPassword.php

namespace App\Mail;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $password_token;

    /**
     * Create a new message instance.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function __construct($user, $password_token)
    {
        $this->user = $user;
        $this->password_token = $password_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailTemplate = EmailTemplate::where('name', 'reset_password_email')->first();

        // Replace placeholders with actual values
        $body = str_replace('{{name}}', $this->user->last_name . ' ' . $this->user->first_name, $emailTemplate->body);
        // Assuming you have a method to generate the reset password link
        $resetLink = route('admin.auth.resetPassword', ['token' => $this->password_token->token]);
        $body = str_replace('{{reset_link}}', $resetLink, $body);

        return $this->view('emails.reset_password', compact('body'))->subject($emailTemplate->subject);
    }
}

