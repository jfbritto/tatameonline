<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;

class SendMailUser extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $password;
    public $academy;
    public $type;
    public $invoice;
    public $email;

    /**
     * Create a new message instance.
     * @param User $user
     *
     * @return void
     */
    public function __construct(User $user, $type = "1", $password = "", $academy = "", $invoice = "")
    {
        $this->user = $user;
        $this->password = $password;
        $this->academy = $academy;
        $this->type = $type;
        $this->invoice = $invoice;
        $this->email = $this->user->academy->siteName."@tatameonline.com";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        switch ($this->type) {
            case '1':

                return $this->from($this->email)
                            ->subject("Bem-vindo!")
                            ->view('emails.welcome')
                            ->with([
                                'user' => $this->user,
                                'password' => $this->password,
                                'academy' => $this->academy,
                            ]);
                break;

            case '2':

                return $this->from($this->email)
                            ->subject("Pagamento confirmado!")
                            ->view('emails.payment')
                            ->with([
                                'user' => $this->user,
                                'invoice' => $this->invoice,
                            ]);
                break;
        }

    }
}
