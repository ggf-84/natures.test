<?php

namespace App\Http\Terranet\Administrator\Modules;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Terranet\Administrator\Contracts\Module\Editable;
use Terranet\Administrator\Contracts\Module\Exportable;
use Terranet\Administrator\Contracts\Module\Filtrable;
use Terranet\Administrator\Contracts\Module\Navigable;
use Terranet\Administrator\Contracts\Module\Sortable;
use Terranet\Administrator\Contracts\Module\Validable;
use Terranet\Administrator\Filters\Element\Select;
use Terranet\Administrator\Form\Element;
use Terranet\Administrator\Form\FormElement;
use Terranet\Administrator\Scaffolding;
use Terranet\Administrator\Traits\Module\AllowFormats;
use Terranet\Administrator\Traits\Module\AllowsNavigation;
use Terranet\Administrator\Traits\Module\HasFilters;
use Terranet\Administrator\Traits\Module\HasForm;
use Terranet\Administrator\Traits\Module\HasSortable;
use Terranet\Administrator\Traits\Module\ValidatesForm;
use App\Quiz;

/**
 * Administrator Resource Quizzes
 *
 * @package Terranet\Administrator
 */
class Quizzes extends Scaffolding implements Navigable, Filtrable, Editable, Validable, Sortable, Exportable
{
    use HasFilters, HasForm, HasSortable, ValidatesForm, AllowFormats, AllowsNavigation;

    /**
     * The module Eloquent model
     *
     * @var string
     */
    protected $model = '\App\Quiz';

    public $icon = '<i class="fa fa-question-circle"></i>';

    public function linkAttributes()
    {
        return ['icon' => 'fa fa-question-circle'];
    }

    public function group()
    {
        return 'Quiz';
    }

    public function inputTypes()
    {
        return ['label_question' => 'textarea', 'rank' => 'number', 'parent_id' => 'number', 'formula_qty' => 'text'];
    }

    public function columns()
    {
        return $this->scaffoldColumns()
            ->move('question', 1)->move('rank', 2)
            ->without(['parent_id', 'formula_qty', 'custom_field', 'custom_formula', 'label_question']);
    }

    public function form()
    {
        return $this->scaffoldForm()
            ->update('label_question', function ($element) {
                $title = 'Label: <a href="'. asset('admin/doc/example.txt') .'" download>Example data format</a>' ;
                $element->setTitle($title);
                return $element;
            })
            ->update('quiz_type', function (FormElement $element) {
                $element->setInput(new Select('quiz_type'));
                $element->getInput()->setOptions(Quiz::quizTypeList());
            })
            ->update('unit_measure', function (FormElement $element) {
                $element->setInput(new Select('unit_measure'));
                $element->getInput()->setOptions(Quiz::unitMeasureList());
            })
            ->update('quiz_page_attribute', function (FormElement $element) {
                $element->setInput(new Select('quiz_page_attribute'));
                $element->getInput()->setOptions(Quiz::quizTypePageList());
            })
            ->update('parent_id', function (FormElement $element) {
                $element->setInput(new Select('parent_id'));
                $element->getInput()->setOptions(Quiz::parentList());
            })
            ->update('icon', function (FormElement $element) {
                $element->setInput(new Select('icon'));
                $element->getInput()->setOptions(Quiz::iconList());
            });
    }

    public function filters()
    {
        return $this->scaffoldFilters();
    }

    /**
     * @param Model|null $model
     */
    public function viewColumns(Model $model = null)
    {
        return $this->scaffoldViewColumns($model ?: app('scaffold.model'))
            ->without(['formula_qty','rank'])
            ->update('id', function ($row) { $row->setTitle('ID'); })
            ->move('question', 1)
            ->move('label_question', 2)->update('label_question', function ($row) { $row->setTitle('Label'); })
            ->move('active', 12)->update('active', function ($element) {
                $element->display(function ($row) {
                    return $row->active ? 'Active' : 'Inactive';
                });
            })
            ->move('parent_id', 3)->update('parent_id', function ($element) {
                $element->display(function ($row) {
                    return $row->parent->question;
                });
            })
            ->update('custom_formula', function ($element) {
                $element->display(function ($row) {
                    return $row->custom_formula ? 'Yes' : 'No';
                });
            })
            ->update('custom_field', function ($element) {
                $element->display(function ($row) {
                    return $row->custom_field ? 'Yes' : 'No';
                });
            });
    }
}
