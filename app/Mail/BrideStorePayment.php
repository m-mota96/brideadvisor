<?php

namespace App\Mail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BrideStorePayment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->markdown('emails.customer.paymentstore')->subject('Pago completado')->with([
            'name' => $this->data['name'],
            'img' => $this->data['qr'],
            'price' => $this->data['price'],
            'addresses' => '<span>Su cita fue generada para asistir a la sucursal ubicada en:<br>'.$this->data['address'].'</span>'
        ]);
        $email->attach('media/pdf/citas/'.$this->data['name_qr'].'.pdf');
        return $email;
    }
}
