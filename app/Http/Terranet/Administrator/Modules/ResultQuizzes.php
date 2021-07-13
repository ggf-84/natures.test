<?php

namespace App\Http\Terranet\Administrator\Modules;

use Illuminate\Database\Eloquent\Model;
use Terranet\Administrator\Contracts\Module\Editable;
use Terranet\Administrator\Contracts\Module\Exportable;
use Terranet\Administrator\Contracts\Module\Filtrable;
use Terranet\Administrator\Contracts\Module\Navigable;
use Terranet\Administrator\Contracts\Module\Sortable;
use Terranet\Administrator\Contracts\Module\Validable;
use Terranet\Administrator\Form\Element;
use Terranet\Administrator\Form\FormElement;
use Terranet\Administrator\Scaffolding;
use Terranet\Administrator\Traits\Module\AllowFormats;
use Terranet\Administrator\Traits\Module\AllowsNavigation;
use Terranet\Administrator\Traits\Module\HasFilters;
use Terranet\Administrator\Traits\Module\HasForm;
use Terranet\Administrator\Traits\Module\HasSortable;
use Terranet\Administrator\Traits\Module\ValidatesForm;

/**
 * Administrator Resource ResultQuiz
 *
 * @package Terranet\Administrator
 */
class ResultQuizzes extends Scaffolding implements Navigable, Filtrable, Editable, Validable, Sortable, Exportable
{
    use HasFilters, HasForm, HasSortable, ValidatesForm, AllowFormats, AllowsNavigation;

    /**
     * The module Eloquent model
     *
     * @var string
     */
    protected $model = '\App\ResultQuiz';

    public function group()
    {
        return 'Quiz';
    }

//    public $icon = '<i class="fa fa-question-circle"></i>';

//    public function linkAttributes()
//    {
//        return ['icon' => 'fa fa-question-circle'];
//    }

    public function inputTypes()
    {
        return [
            'main_title_block_1' => 'text',
            'description_block_1' => 'text',
            'main_title_block_2' => 'text',
            'main_title_block_3' => 'text',
            'description_block_3' => 'text',
            'title_block_3_a' => 'text',
            'description_block_3_a' => 'text',
            'label_block_3_a' => 'text',
            'title_block_3_b' => 'text',
            'description_block_3_b' => 'text',
            'label_block_3_b' => 'text',
            'title_block_3_c' => 'text',
            'description_block_3_c' => 'text',
            'label_block_3_c' => 'text',
            'title_block_3_d' => 'text',
            'description_block_3_d' => 'text',
            'label_block_3_d' => 'text'
        ];
    }

    public function columns()
    {
        return $this->scaffoldColumns()
            ->update('main_title_block_1', function ($element) { return $element->setTitle('Title');})
            ->update('description_block_1', function ($element) {return $element->setTitle('Description');})
            ->without([
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
            ]);
    }

    public function form()
    {
        return $this->scaffoldForm()
        ->without(['id']);
    }

    public function viewColumns(Model $model = null)
    {
        return $this->scaffoldViewColumns($model ?: app('scaffold.model'))
            ->without(['id']);
    }
}
