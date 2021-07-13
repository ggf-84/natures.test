<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Terranet\Rankable\HasRankableField;
use Terranet\Rankable\Rankable;
use Terranet\Translatable\HasTranslations;
use Terranet\Translatable\Translatable;

class Paragraph extends Model implements Translatable, Rankable
{
    use HasTranslations, HasRankableField;

    const TYPE_FAQ = 'faq';
    const TYPE_PRIVACY_POLICY = 'privacy-policy';
    const TYPE_TERMS_OFS_SERVICE = 'terms-of-service';

    public $timestamps = false;

    protected $with = ['translations'];

    protected $fillable = ['type', 'rank', 'active'];

    protected $translatedAttributes = ['title', 'description'];

    protected static $unguarded = true;

    public static function typesList($addEmpty = false)
    {
        $items = [
            self::TYPE_FAQ => self::TYPE_FAQ,
            self::TYPE_PRIVACY_POLICY => self::TYPE_PRIVACY_POLICY,
            self::TYPE_TERMS_OFS_SERVICE => self::TYPE_TERMS_OFS_SERVICE,
        ];

        return $addEmpty ? ['' => '--Any--'] + $items : $items;
    }

    public static function getListByType($type)
    {
        return (new static)
            ->orderBy('rank', 'DESC')
            ->where('active', true)
            ->where('type', $type)
            ->get();
    }
}
