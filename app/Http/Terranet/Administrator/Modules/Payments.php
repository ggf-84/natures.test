<?php

namespace App\Http\Terranet\Administrator\Modules;

use App\Donation;
use App\Payment;
use function foo\func;
use Terranet\Administrator\Contracts\Module\Editable;
use Terranet\Administrator\Contracts\Module\Exportable;
use Terranet\Administrator\Contracts\Module\Filtrable;
use Terranet\Administrator\Contracts\Module\Navigable;
use Terranet\Administrator\Contracts\Module\Sortable;
use Terranet\Administrator\Contracts\Module\Validable;
use Terranet\Administrator\Filters\Element\Daterange;
use Terranet\Administrator\Filters\Element\Number;
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
 * Administrator Resource Payments
 *
 * @package Terranet\Administrator
 */
class Payments extends Scaffolding implements Navigable, Filtrable, Editable, Validable, Sortable, Exportable
{
    use HasFilters, HasForm, HasSortable, ValidatesForm, AllowFormats, AllowsNavigation;

    /**
     * The module Eloquent model
     *
     * @var string
     */
    protected $model = '\App\Payment';

    public function columns()
    {
        $columns = $this->scaffoldColumns();
        $columns->without(['payment_id', 'payer_id', 'token', 'actions']);

        return $columns;
    }

    public function filters()
    {
        $filters = $this->scaffoldFilters();

        $filters->push('status', function (FormElement $element) {
            $element->setInput(new Select('status'));
            $element->getInput()->setOptions((new Payment)->availableStatuses(true));
        });

        $filters->push('payment_method', function (FormElement $element) {
            $element->setInput(new Select('payment_method'));
            $element->getInput()->setOptions(Donation::paymentTypesList(true));

            $element->setQuery(function ($query, $value = null) {
                return $query->paymentType($value);
            });
        });

        $filters->push('payment_date', function (FormElement $element) {
            $element->setInput(new Daterange('payment_date'));
        });

        $filters->push('amount_from', function (FormElement $element) {
            $element->setInput(new Number('amount_from'));

            $element->setQuery(function ($query, $value = null) {
                return $query->amountFrom($value);
            });
        });

        $filters->push('amount_to', function (FormElement $element) {
            $element->setInput(new Number('amount_to'));

            $element->setQuery(function ($query, $value = null) {
                return $query->amountTo($value);
            });
        });

        return $filters;
    }

    public function linkAttributes()
    {
        return ['icon' => 'fa fa-money'];
    }

    public function canDelete()
    {
        return false;
    }

    public function canView()
    {
        return false;
    }

    public function canCreate()
    {
        return false;
    }

    public function canUpdate()
    {
        return false;
    }

    public function formats()
    {
        return false;
    }
}
