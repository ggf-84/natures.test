<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'code'];

    public $timestamps = false;

    public static function getList($addEmpty = false)
    {
        $items = (new static)->orderBy('name', 'ASC')
            ->pluck('name', 'id')
            ->toArray();

        return $addEmpty ? ['' => '--Any--'] + $items : $items;
    }

    public static function getDefault()
    {
        return static::where('code', 'US')->first();
    }
}
