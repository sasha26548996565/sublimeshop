<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Product $product)
    {}

    public function build()
    {
        return $this->markdown('mail.product.created', ['product' => $this->product]);
    }
}
