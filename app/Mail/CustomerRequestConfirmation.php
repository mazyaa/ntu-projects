<?php

namespace App\Mail;

use App\Models\InspectionRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerRequestConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public InspectionRequest $request,
    ) {}

    public function build(): static
    {
        return $this->view('emails.customer-request-confirmation')
            ->subject("Konfirmasi Permohonan Riksa Uji - {$this->request->request_number}");
    }
}
