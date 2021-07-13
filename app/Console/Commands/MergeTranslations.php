<?php
/** @noinspection PhpIncludeInspection */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Terranet\Localizer\Locale;

class MergeTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:merge {folder_new} {folder_old}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Merge production translations with local';

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
        $folderNew = realpath($this->argument('folder_new'));
        $folderOld = realpath($this->argument('folder_old'));

        $files = include($folderNew.'/config/translations.php');

        foreach ($files['files'] as $file) {
            foreach (\localizer\locales() as $lang) {
                /** @var Locale $lang */
                $path = '/resources/lang/'.$lang->iso6391().'/'.$file.'.php';

                $old = file_exists($folderOld.$path)
                    ? (array) array_dot(include($folderOld.$path))
                    : [];
                $new = file_exists($folderNew.$path)
                    ? (array) array_dot(include($folderNew.$path))
                    : [];

                $this->merge($old, $new, $folderNew.$path);
            }
        }
    }

    private function merge($old, $new, $file)
    {
        if (!$new || !$old) {
            return;
        }

        if ($old !== $new) {
            $content = var_export(array_merge($new, $old), true);

            $content = '<?php'.PHP_EOL.'return '.$content.';';
            file_put_contents($file, $content);
        }
    }
}
