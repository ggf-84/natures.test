<?php

namespace App\Listeners;

use App\Events\ClientNotification;
use App\Services\DonationService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use function localizer\locale;
use function localizer\locales;

class EmailNotificationListener implements ShouldQueue
{
    use InteractsWithQueue;

    protected $donationService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }

    /**
     * Handle the event.
     *
     * @param  ClientNotification $event
     * @return void
     */
    public function handle(ClientNotification $event)
    {
        $locale = $event->locale;

        foreach (locales() as $item) {
            if ($item->iso6391() == $locale) {
                $locale = $item;

                break;
            }
        }

        app('terranet.localizer')->setLocale($locale);

        $this->donationService->sendClientNotification($event->donation);
    }
}
