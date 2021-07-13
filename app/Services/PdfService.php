<?php

namespace App\Services;

use Symfony\Component\Process\Process;

class PdfService
{
    public function generate($content, $path)
    {
        $process = new Process("/usr/local/bin/weasyprint --encoding utf8 - {$path}");
        $process->setInput($content);
        $process->run();
    }
}
