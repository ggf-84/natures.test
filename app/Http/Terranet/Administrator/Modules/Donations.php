<?php

namespace App\Http\Terranet\Administrator\Modules;

use App\Country;
use App\Donation;
use App\Http\Terranet\Widgets\DonationPayments;
use Illuminate\Database\Eloquent\Model;
use Terranet\Administrator\Contracts\Module\Editable;
use Terranet\Administrator\Contracts\Module\Exportable;
use Terranet\Administrator\Contracts\Module\Filtrable;
use Terranet\Administrator\Contracts\Module\Navigable;
use Terranet\Administrator\Contracts\Module\Sortable;
use Terranet\Administrator\Contracts\Module\Validable;
use Terranet\Administrator\Filters\Element\Daterange;
use Terranet\Administrator\Filters\Element\Select;
use Terranet\Administrator\Filters\Element\Text;
use Terranet\Administrator\Form\FormElement;
use Terranet\Administrator\Scaffolding;
use Terranet\Administrator\Services\Widgets\AbstractWidget;
use Terranet\Administrator\Traits\Module\AllowFormats;
use Terranet\Administrator\Traits\Module\AllowsNavigation;
use Terranet\Administrator\Traits\Module\HasFilters;
use Terranet\Administrator\Traits\Module\HasForm;
use Terranet\Administrator\Traits\Module\HasSortable;
use Terranet\Administrator\Traits\Module\ValidatesForm;

/**
 * Administrator Resource Donations
 *
 * @package Terranet\Administrator
 */
class Donations extends Scaffolding implements Navigable, Filtrable, Editable, Validable, Sortable, Exportable
{
    use HasFilters, HasForm, HasSortable, ValidatesForm, AllowFormats, AllowsNavigation;

    /**
     * The module Eloquent model
     *
     * @var string
     */
    protected $model = '\App\Donation';

    public function columns()
    {
        $columns = $this->scaffoldColumns();

        $columns->without(['comment', 'dedicate_message']);

        $columns->stack(['name', 'type'], 'donor');
        $columns->stack(['phone', 'email'], 'contacts');
        $columns->stack(['country_id', 'city', 'address'], 'address');
        $columns->stack(['dedicated', 'dedicate_name', 'dedicate_type'], 'dedicate');
        $columns->stack(['trees', 'amount'], 'total');
        $columns->stack(['payment_type', 'recurring'], 'payment');

        return $columns;
    }


    public function filters()
    {
        $filters = $this->scaffoldFilters();

        $filters->push('type', function (FormElement $element) {
            $element->setInput(new Select('type'));
            $element->getInput()->setOptions(Donation::typesList(true));
        });

        $filters->push('country_id', function (FormElement $element) {
            $element->setInput(new Select('country_id'));
            $element->getInput()->setOptions(Country::getList(true));
        });

        $filters->push('created_at', function (FormElement $element) {
            $element->setInput(new Daterange('created_at'));
        });

        $filters->push('keyword', function (FormElement $element) {
            $element->setInput(new Text('keyword'));

            $element->setQuery(function ($query, $value = null) {
                return $query->keyword($value);
            });
        });

        return $filters;
    }

    public function viewColumns(Model $model = null)
    {
        return $this->scaffoldViewColumns($model);
    }

    public function widgets()
    {
        $donation = app('scaffold.model');

        return $this->scaffoldWidgets()
            ->push((new DonationPayments($donation))->setPlacement(AbstractWidget::PLACEMENT_MAIN_BOTTOM));
    }

    public function linkAttributes()
    {
        return ['icon' => 'fa fa-gift'];
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
