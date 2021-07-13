<?php

namespace App\Services;

use App\Donation;
use App\Services\Payment\PaymentInterface;
use App\Services\Payment\PayPalService;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class DonationService
{
    public function sendClientNotification(Donation $donation)
    {
        list($certificatePath, $certificateFile) = $this->generateCertificate($donation);

        Mail::send(
            'emails.client-notification',
            [
                'donation' => $donation,
                'certificateFile' => $certificateFile,
            ],
            function (Message $message) use ($donation, $certificatePath) {
                $message->to($donation->email, $donation->name);
                $message->from(config('mail.from.address'), config('mail.from.name'));
                $message->replyTo(config('mail.reply.address'));
                $message->subject(trans('email.notifications.client.subject'));

                $message->attach($certificatePath);
            }
        );
    }

    /**
     * @param  Donation  $donation
     * @param  bool  $debug
     * @return array
     */
    public function generateCertificate(Donation $donation, bool $debug = false)
    {
        $folderName = 'certificates/' . md5($donation->id . $donation->created_at);
        $fileName = '/natures-certificate.pdf';

        $folder = public_path($folderName);

        if (!file_exists($folder)) {
            File::makeDirectory($folder, $mode = 0777, true, true);
        }

        $path = $folder . $fileName;

        if (file_exists($path)) {
            File::delete($path);
        }

        $content = View::make('certificates.' . ($donation->dedicated ? 'in_memory' : 'appreciation'), [
            'donation' => $donation
        ]);

        if ($debug) {
            return [$path, $content];
        }

        $pdfService = new PdfService();
        $pdfService->generate($content->render(), $path);

        return [$path, $folderName . $fileName];
    }

    public function getPaymentService(Donation $donation): PaymentInterface
    {
        if (Donation::PAYMENT_BITCOIN == $donation->payment_type) {
            //
        }

        return new PayPalService();
    }
}
