<?php

namespace App\Services\Pages;

use App\Page;
use function localizer\locale;

class Finder
{
    public function fetch($slug)
    {
        if ($page = (new Page)->where('key', $slug)->first(['pages.*'])) {
            return $page;
        }

        return (new Page)
            ->join('page_translations as pt', function ($join) {
                $join->on('pt.page_id', '=', 'pages.id')
                     ->where('pt.language_id', '=', (int)locale()->id());
            })
            ->where('slug', $slug)
            ->first(['pages.*']);
    }
}
