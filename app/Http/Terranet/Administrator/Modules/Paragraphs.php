<?php

namespace App\Http\Terranet\Administrator\Modules;

use App\Paragraph;
use Terranet\Administrator\Contracts\Module\Editable;
use Terranet\Administrator\Contracts\Module\Exportable;
use Terranet\Administrator\Contracts\Module\Filtrable;
use Terranet\Administrator\Contracts\Module\Navigable;
use Terranet\Administrator\Contracts\Module\Sortable;
use Terranet\Administrator\Contracts\Module\Validable;
use Terranet\Administrator\Filters\Element\Select;
use Terranet\Administrator\Form\FormElement;
use Terranet\Administrator\Scaffolding;
use Terranet\Administrator\Traits\Module\AllowFormats;
use Terranet\Administrator\Traits\Module\AllowsNavigation;
use Terranet\Administrator\Traits\Module\HasFilters;
use Terranet\Administrator\Traits\Module\HasForm;
use Terranet\Administrator\Traits\Module\HasSortable;
use Terranet\Administrator\Traits\Module\ValidatesForm;

/**
 * Administrator Resource Paragraphs
 *
 * @package Terranet\Administrator
 */
class Paragraphs extends Scaffolding implements Navigable, Filtrable, Editable, Validable, Sortable, Exportable
{
    use HasFilters, HasForm, HasSortable, ValidatesForm, AllowFormats, AllowsNavigation;

    /**
     * The module Eloquent model
     *
     * @var string
     */
    protected $model = '\App\Paragraph';

    public function linkAttributes()
    {
        return ['icon' => 'fa fa-paragraph'];
    }

    public function inputTypes()
    {
        return ['description' => 'tinymce'];
    }

    public function form()
    {
        return $this->scaffoldForm()
            ->update('type', function (FormElement $element) {
                $element->setInput(new Select('type'));
                $element->getInput()->setOptions(Paragraph::typesList());
            })->without(['rank']);
    }

    public function filters()
    {
        return $this->scaffoldFilters()->push('type', function (FormElement $element) {
            $element->setInput(new Select('type'));
            $element->getInput()->setOptions(Paragraph::typesList(true));
        });
    }
}
