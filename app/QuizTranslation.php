<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizTranslation extends Model
{
    protected $fillable = ['question', 'label_question', 'description'];

    public $timestamps = false;
}
