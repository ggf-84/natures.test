<?php

use App\Services\View\SVGLoader;

function widget($name, $key = null)
{
    $page = new \App\Services\Pages\Translator($name);

    return $key ? $page->get($key) : $page;
}

function icon($name)
{
    return app(SVGLoader::class)->load($name);
}
