<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Terranet\Rankable\HasRankableField;
use Terranet\Rankable\Rankable;
use Terranet\Translatable\HasTranslations;
use Terranet\Translatable\Translatable;
use Illuminate\Support\Collection;

class Quiz extends Model implements Translatable, Rankable
{
    use HasTranslations, HasRankableField;

    const QUIZ_TYPE_PAGE_HOUSE = 'house';
    const QUIZ_TYPE_PAGE_TRANSPORT = 'transport';
    const QUIZ_TYPE_PAGE_FOOD = 'food';
    const QUIZ_TYPE_PAGE_LIFESTYLE = 'lifestyle';

    const QUIZ_TYPE_PROGRESS = 'progress';
    const QUIZ_TYPE_SELECT = 'select';
    const QUIZ_TYPE_RADIO = 'radio';
    const QUIZ_TYPE_INPUT = 'input';
    const QUIZ_TYPE_SWITCH = 'switch';
    const QUIZ_TYPE_CHECKBOX = 'checkbox';
    const QUIZ_TYPE_TEXT = 'text';


    const UNIT_MEASURE_KWH = 'kwh';
    const UNIT_MEASURE_HOUR = 'hours';
    const UNIT_MEASURE_MILE = 'miles';
    const UNIT_MEASURE_MPG = 'mpg';
    const UNIT_MEASURE_TONES = 'tones';
    const UNIT_MEASURE_CARS = 'cars';

    const NONE = 'none';
    const BUS = 'bus';
    const CAR = 'car';
    const ELECTRICITY = 'electricity';
    const FOOD = 'food';
    const GAS = 'gas';
    const MAN = 'man';
    const PLANE = 'plane';
    const WALLET = 'wallet';

    public $timestamps = false;

    protected $with = ['translations'];

    protected $fillable = [
        'quiz_page_attribute',
        'quiz_type',
        'unit_measure',
        'parent_id',
        'rank',
        'formula_qty',
        'custom_field',
        'custom_formula',
        'active',
        'icon'
    ];

    protected $translatedAttributes = ['question','description','label_question'];

    protected static $unguarded = true;

    public static function quizTypeList($addEmpty = false)
    {
        $items = [
            self::QUIZ_TYPE_PROGRESS => self::QUIZ_TYPE_PROGRESS,
            self::QUIZ_TYPE_SELECT => self::QUIZ_TYPE_SELECT,
            self::QUIZ_TYPE_RADIO => self::QUIZ_TYPE_RADIO,
            self::QUIZ_TYPE_INPUT => self::QUIZ_TYPE_INPUT,
            self::QUIZ_TYPE_SWITCH => self::QUIZ_TYPE_SWITCH,
            self::QUIZ_TYPE_CHECKBOX => self::QUIZ_TYPE_CHECKBOX,
            self::QUIZ_TYPE_TEXT => self::QUIZ_TYPE_TEXT,
        ];

        return $addEmpty ? ['' => '--Any--'] + $items : $items;
    }

    public static function quizTypePageList($addEmpty = false)
    {
        $items = [
            self::QUIZ_TYPE_PAGE_HOUSE => self::QUIZ_TYPE_PAGE_HOUSE,
            self::QUIZ_TYPE_PAGE_TRANSPORT => self::QUIZ_TYPE_PAGE_TRANSPORT,
            self::QUIZ_TYPE_PAGE_FOOD => self::QUIZ_TYPE_PAGE_FOOD,
            self::QUIZ_TYPE_PAGE_LIFESTYLE => self::QUIZ_TYPE_PAGE_LIFESTYLE,
        ];

        return $addEmpty ? ['' => '--Any--'] + $items : $items;
    }

    public static function unitMeasureList($addEmpty = false)
    {
        $items = [
            self::UNIT_MEASURE_KWH => self::UNIT_MEASURE_KWH,
            self::UNIT_MEASURE_HOUR => self::UNIT_MEASURE_HOUR,
            self::UNIT_MEASURE_MILE => self::UNIT_MEASURE_MILE,
            self::UNIT_MEASURE_MPG => self::UNIT_MEASURE_MPG,
            self::UNIT_MEASURE_TONES => self::UNIT_MEASURE_TONES,
            self::UNIT_MEASURE_CARS => self::UNIT_MEASURE_CARS,
        ];

        return $addEmpty ? ['' => '--Any--'] + $items : $items;
    }

    public static function iconList($addEmpty = false)
    {
        $items = [
            self::NONE => self::NONE,
            self::BUS => self::BUS,
            self::CAR => self::CAR,
            self::ELECTRICITY => self::ELECTRICITY,
            self::FOOD => self::FOOD,
            self::GAS => self::GAS,
            self::MAN => self::MAN,
            self::PLANE => self::PLANE,
            self::WALLET => self::WALLET,
        ];

        return $addEmpty ? ['' => '--None--'] + $items : $items;
    }

    public static function parentList($addEmpty = false)
    {
        $items =  (new static)::all()->pluck('question', 'id')->toArray();
        return [0 => '--No parent--'] + $items;
    }

    public function parent()
    {
        return $this->belongsTo((new static));
    }
}
