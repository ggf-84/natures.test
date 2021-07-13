<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Terranet\Translatable\HasTranslations;
use Terranet\Translatable\Translatable;

class ResultQuiz extends Model implements Translatable
{
    use HasTranslations;

    protected $with = ['translations'];

    protected $translatedAttributes = [
        'main_title_block_1',
        'description_block_1',
        'main_title_block_2',
        'main_title_block_3',
        'description_block_3',
        'title_block_3_a',
        'description_block_3_a',
        'label_block_3_a',
        'title_block_3_b',
        'description_block_3_b',
        'label_block_3_b',
        'title_block_3_c',
        'description_block_3_c',
        'label_block_3_c',
        'title_block_3_d',
        'description_block_3_d',
        'label_block_3_d'
    ];

    public $timestamps = false;
}
