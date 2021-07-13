<?php

namespace App\Services\Pages;

use App\Page;
use Terranet\Localizer\Locale;

class Translator
{
    protected $name;

    protected static $storage = [];

    protected $locale = null;

    public function __construct($name, Locale $locale = null)
    {
        $this->name = $name;

        $this->locale = $locale ?: \localizer\locale();
    }

    public function setLocale(Locale $locale)
    {
        $this->locale = $locale;
    }

    /**
     * Retrieve translated content by key.
     *
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return array_get(
            $this->pageContent(),
            $key,
            ''
        );
    }

    /**
     * Retrieve translated content as Array.
     *
     * @param null $key
     * @return array
     */
    public function toArray($key = null): array
    {
        $content = $this->pageContent();

        return $key ? $content[$key] : $content;
    }

    /**
     * Retrieve translated content as JSON.
     *
     * @param null $key
     * @return string
     */
    public function toJson($key = null)
    {
        return json_encode($this->toArray($key));
    }

    /**
     * Retrieve image url.
     *
     * @param $name
     * @param string $size
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function image($name, $size = 'original')
    {
        return $this->get($name) ? url($this->get($name)->url($size)) : '';
    }

    /**
     * Fetch & Cache page content.
     *
     * @return array
     */
    public function pageContent(): array
    {
        $lang = $this->locale->iso6391();

        return cache()->remember("page_content:{$this->name}:{$lang}", $this->cacheLifetime(), function () {
            $page = $this->currentPage();

            $storage = [];

            $page->pageElements()
                 ->with(['translations' => function ($query) {
                     $query->where('language_id', '=', $this->locale->id());
                 }])
                 ->get()
                 ->map(function ($item) use (&$storage) {
                     $data = $item->toArray();

                     $content = array_get($data, 'translations.0.content', $item->content);

                     array_set(
                         $storage,
                         $item->key,
                         $item->image->originalFilename() ? $item->image : $content
                     );
                 });

            return $storage;
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    protected function currentPage()
    {
        return Page::where('key', $this->name)->first();
    }

    protected function cacheLifetime()
    {
        return app()->isLocal() ? 0.2 : 60;
    }
}
