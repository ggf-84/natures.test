<?php

namespace App;

use App\Presenters\PagePresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Terranet\Presentable\PresentableInterface;
use Terranet\Presentable\PresentableTrait;
use Terranet\Translatable\HasTranslations;
use Terranet\Translatable\Translatable;

class Page extends Model implements Translatable, PresentableInterface
{
    const TYPE_PAGE = 'page';
    const TYPE_WIDGET = 'widget';

    protected static $types = [
        self::TYPE_PAGE,
        self::TYPE_WIDGET,
    ];

    use HasTranslations, PresentableTrait;

    protected $with = ['translations'];

    protected $fillable = ['key', 'active', 'type', 'admin_title'];

    protected $translatedAttributes = ['slug', 'title', 'body', 'meta_title', 'meta_keywords', 'meta_description'];

    protected $presenter = PagePresenter::class;

    public static function availableTypes($addEmpty = false)
    {
        $out = [];

        foreach (static::$types as $type) {
            $out[$type] = trans('administrator::columns.pages.types.' . $type);
        }

        return $addEmpty ? ['' => '--Any--'] + $out : $out;
    }

    public function pageElements(): HasMany
    {
        return $this->hasMany(PageElement::class);
    }

    public function elements()
    {
        return $this->pageElements->keyBy('key');
    }

    public function isWidget()
    {
        return $this->type == self::TYPE_WIDGET;
    }

    public function isPage()
    {
        return $this->type == self::TYPE_PAGE;
    }

    public function scopeCustomPages($query)
    {
        return $query->pages()->whereNotNull('key');
    }

    public function scopeWidgets($query)
    {
        return $query->where('type', static::TYPE_WIDGET);
    }

    /**
     * @hidden
     * @param $query
     * @return mixed
     */
    public function scopePages($query)
    {
        return $query->where('type', static::TYPE_PAGE);
    }

    public function sortableColumn()
    {
        return \DB::raw('IFNULL(pages.key, tt.slug)');
    }

    /**
     * Get item identifier.
     *
     * @return mixed|int|string
     */
    public function navigationKey()
    {
        return $this->id;
    }

    /**
     * Get item title.
     *
     * @return string
     */
    public function navigationTitle()
    {
        return $this->isDynamicPage() ? trans('ui.top_navigation.' . $this->key) : $this->title;
    }

    public function isDynamicPage()
    {
        return $this->key ? true : false;
    }

    public function isStaticPage()
    {
        return $this->isPage() && !$this->isDynamicPage();
    }

    /**
     * Build item url.
     *
     * @return string
     */
    public function navigationUrl()
    {
        return route('pages.show', ['page' => $this->isDynamicPage() ? $this->key : $this->slug]);
    }
}
