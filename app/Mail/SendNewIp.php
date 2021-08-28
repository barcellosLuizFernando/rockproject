<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Config;

class SendNewIp extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Config instance
     */
    protected $config;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->markdown('emails.newip', ['config' => $this->config])
            ->subject('Rockingleses - Novo IP');
    }
}
