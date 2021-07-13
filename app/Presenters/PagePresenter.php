<?php

namespace App\Presenters;

use function admin\output\label;
use Terranet\Presentable\Presenter;

class PagePresenter extends Presenter
{
    protected $typeLabels = [
        'page' => 'primary',
        'widget' => 'info',
    ];

    public function adminType()
    {
        return tap(trans('administrator::columns.pages.types.' . $this->presentable->type), function (&$text) {
            $text = label($text, 'label-' . $this->typeLabels[$this->presentable->type]);
        });
    }

    public function getAdminTitle()
    {
        return !$this->presentable->key || $this->presentable->title ? $this->presentable->title : $this->presentable->admin_title;
    }
}
