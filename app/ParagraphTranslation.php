<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParagraphTranslation extends Model
{
    protected $fillable = ['title', 'description'];

    public $timestamps = false;
}
