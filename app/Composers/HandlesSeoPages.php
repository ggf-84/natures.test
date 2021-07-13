<?php

namespace App\Composers;

use App\Page;
use App\Services\Pages\Finder;
use Artesaos\SEOTools\Contracts\SEOTools as SEOToolsContract;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Database\Eloquent\Model;

trait HandlesSeoPages
{
    use SEOTools;

    /**
     * Retrieve the Seo Object by parameter name.
     *
     * @param  string  $type
     *
     * @return Model
     */
    protected function seoObject($type)
    {
        switch ($type) {
            case 'page':
                return $this->route->parameter($type);
        }

        return null;
    }

    /**
     * Set Page SEO tags.
     *
     * @param  Page  $page
     * @return SEOToolsContract
     */
    protected function pageMeta(Page $page)
    {
        return $this->genericMeta($page);
    }

    /**
     * Set generic SEO tags for eloquent object.
     *
     * @param $eloquent  - a model having meta.
     * @return SEOToolsContract
     */
    protected function genericMeta($eloquent)
    {
        with($seo = $this->seo())
            ->setTitle(!empty($eloquent->meta_title) ? $eloquent->meta_title : $eloquent->title)
            ->setDescription(!empty($eloquent->meta_description) ? $eloquent->meta_description : null);
        $seo->metatags()->setKeywords(!empty($eloquent->meta_keywords) ? $eloquent->meta_keywords : null);

        $seo->opengraph()->setUrl($this->currentUrl());
        $seo->opengraph()->addImage(asset('/img/scene-intro/main.jpg'));
        $seo->opengraph()->addProperty('locale', $this->locale->locale());

        return $seo;
    }

    /**
     * @param $eloquent
     * @return mixed
     */
    protected function titleToKeywords($eloquent)
    {
        return str_replace(' ', ', ', $eloquent->title);
    }

    protected function routeMeta($name)
    {
        $pageFinder = new Finder();
        $page = $pageFinder->fetch($name);
        if (!$page) {
            $page = $pageFinder->fetch('welcome');
        }

        return $this->genericMeta($page);
    }

    public function notFoundMeta()
    {
        $this->seo()->setTitle(trans("general.page-not-found"));
        $this->seo()->setDescription(trans("general.page-not-found"));
    }
}
