<?php

namespace App\Console\Commands;

use App\Donation;
use App\Services\DonationService;
use Illuminate\Console\Command;
use function localizer\locales;

class SendClientNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:send {donation} {locale}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send client notification.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $id = (int)$this->argument('donation');
        $locale = $this->argument('locale');

        if (!$id || !$locale) {
            return;
        }

        $donation = Donation::find($id);

        if (!$donation) {
            return;
        }

        foreach (locales() as $item) {
            if ($item->iso6391() == $locale) {
                $locale = $item;

                break;
            }
        }

        app('terranet.localizer')->setLocale($locale);

        (new DonationService())->sendClientNotification($donation);
    }
}
