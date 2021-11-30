<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderOnlineSuccessfull extends Mailable
{
    use Queueable, SerializesModels;

    protected  $trx_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($trx_id)
    {
        $this->trx_id = $trx_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $trx_id = $this->trx_id;
        return $this->from('ecomprojectone@gmail.com')->view('mail.order-successful', compact('trx_id'))->subject('Payment Email');
    }
}
