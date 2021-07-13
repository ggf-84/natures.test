<?php

namespace App\Http\Terranet\Administrator\Modules;

use App\Page;
use Coduo\PHPHumanizer\StringHumanizer;
use Terranet\Administrator\Contracts\Module\Editable;
use Terranet\Administrator\Contracts\Module\Exportable;
use Terranet\Administrator\Contracts\Module\Filtrable;
use Terranet\Administrator\Contracts\Module\Navigable;
use Terranet\Administrator\Contracts\Module\Sortable;
use Terranet\Administrator\Contracts\Module\Validable;
use Terranet\Administrator\Filters\FilterElement;
use Terranet\Administrator\Form\Collection\Mutable;
use Terranet\Administrator\Form\FormElement;
use Terranet\Administrator\Scaffolding;
use Terranet\Administrator\Traits\Module\AllowFormats;
use Terranet\Administrator\Traits\Module\AllowsNavigation;
use Terranet\Administrator\Traits\Module\HasFilters;
use Terranet\Administrator\Traits\Module\HasForm;
use Terranet\Administrator\Traits\Module\HasSortable;
use Terranet\Administrator\Traits\Module\ValidatesForm;
use function localizer\locale;

/**
 * Administrator Resource Pages
 *
 * @package Terranet\Administrator
 */
class Pages extends Scaffolding implements Navigable, Filtrable, Editable, Validable, Sortable, Exportable
{
    use HasFilters, HasForm, HasSortable, ValidatesForm, AllowFormats, AllowsNavigation;

    /**
     * The module Eloquent model
     *
     * @var string
     */
    protected $model = 'App\\Page';

    public function inputTypes()
    {
        return [
            'body' => 'tinymce',
            'meta_description' => 'textarea',
            'meta_keywords' => 'textarea',
        ];
    }

    public function linkAttributes()
    {
        return ['icon' => 'fa fa-list'];
    }

    public function sortable()
    {
        return array_merge($this->scaffoldSortable(), [
            'active',
            'type',
        ]);
    }

    public function columns()
    {
        $columns = $this->scaffoldColumns();
        $columns->without(['meta_title', 'meta_description', 'meta_keywords', 'body', 'key', 'slug', 'admin_title']);

        $columns->update('title', function ($element) {
            $element->display(function ($row) {
                return $row->present()->getAdminTitle();
            });

            $element->sortable(function ($query, $column, $direction) {
                return $query->orderByRaw("CONCAT_WS(\"\", REPLACE(pages.admin_title, '\"', ''), pt.title) {$direction}");
            });

            return $element;
        });
        $columns->move('title', 'after:id');

        return $columns;
    }

    public function filters()
    {
        return $this->scaffoldFilters()
            ->push(FilterElement::text('title')->setQuery(function ($query, $value) {
                return $query->where('pages.admin_title', 'LIKE', "%{$value}%")
                    ->orWHere('pt.title', 'LIKE', "%{$value}%");
            }));
    }

    public function form()
    {
        $eloquent = app('scaffold.model');
        $without = ['slug', 'key', 'type', 'admin_title'];

        $form = $this->scaffoldForm();

        if ($this->isPage($eloquent) && !$this->isDynamicPage($eloquent)) {
            $form->section(trans('administrator::columns.sections.general_details'), 0);
        }

        if ($this->isWidget($eloquent)) {
            $without = array_merge(
                $without,
                [
                    'admin_title',
                    'meta_title',
                    'meta_description',
                    'meta_keywords',
                    'body',
                    'title',
                    'active',
                ]
            );
        }

        if ($this->isDynamicPage($eloquent)) {
            $without = array_merge($without, ['body', 'title', 'active']);
        }

        $form->without($without);

        $form->when(($eloquent && $eloquent->key), function ($form) use ($eloquent) {
            return $this->widgetColumns($form, $eloquent);
        });

        $form->unless(app('scaffold.model'), function ($form) {
            $form->push(FormElement::hidden('type')->setValue(Page::TYPE_PAGE));
        });

        if ($this->isPage($eloquent)) {
            $form->section(trans('administrator::columns.sections.meta'), $form->count());
            $form->move('meta_title', 'after:meta');
            $form->move('meta_description', 'after:meta_title');
            $form->move('meta_keywords', 'after:meta_description');

            $form->update('meta_title', function ($e) {
                return $e->setDescription(trans('administrator::columns.global.meta_max_symbols'));
            });

            $form->update('meta_description', function ($e) {
                return $e->setDescription(trans('administrator::columns.global.meta_max_symbols'));
            });

            $form->update('meta_keywords', function ($e) {
                return $e->setDescription(trans('administrator::columns.global.meta_max_symbols'));
            });
        }

        return $form;
    }

    private function isPage(Page $eloquent = null)
    {
        return !$eloquent || $eloquent->isPage() ? true : false;
    }

    private function isDynamicPage(Page $eloquent = null)
    {
        return $eloquent && $eloquent->isPage() && $eloquent->isDynamicPage() ? true : false;
    }

    private function isWidget(Page $eloquent = null)
    {
        return $eloquent && $eloquent->isWidget() ? true : false;
    }

    private function widgetColumns(Mutable $form, Page $eloquent)
    {
        if ($widgets = $this->getConfig($eloquent->key)) {
            $elements = $eloquent->elements();

            foreach ($widgets as $widgetKey => $elementsConfigs) {
                $form->section(StringHumanizer::humanize($widgetKey, true, '-'));

                foreach ($elementsConfigs as $key => $type) {
                    $element = FormElement::$type($key);

                    switch ($type) {
                        case 'image':
                            $key = $widgetKey . '.' . $key;
                            $element->setView('admin.widgets.' . $type, compact('key', 'type', 'elements'));
                            $element->setDescription('Allowed formats: SVG<br>
                                Image won\'t be resized. Make sure you upload the proper size.');
                            break;
                        default:
                            $element->setView('admin.widgets.text', compact('key', 'widgetKey', 'type', 'elements'));
                            break;
                    }

                    $form->push($element);
                }
            }
        }

        return $form;
    }

    private function getConfig($key)
    {
        return array_get(config('widgets'), $key);
    }

    public function query($query)
    {
        return $query
            ->leftJoin('page_translations as pt', function ($join) {
                $join->on('pt.page_id', '=', 'pages.id')
                    ->where('pt.language_id', '=', locale()->id());
            });
    }

    public function rules()
    {
        return [
            //'images.*' => 'image|mimes:svg'
        ];
    }
}
