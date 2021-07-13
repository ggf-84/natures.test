<?php

namespace App\Http\Terranet\Administrator\Actions;

use App\PageElement;
use Illuminate\Database\Eloquent\Model;
use Terranet\Administrator\Services\CrudActions;

class Pages extends CrudActions
{
    public function detachFile(Model $item, $attachment)
    {
        $element = PageElement::find($attachment);

        if ($element) {
            $element->delete();
        }

        return parent::detachFile($item, $attachment);
    }

    public function delete(Model $item)
    {
        if ($item->key) {
            return back()->withErrors(trans('administrator::errors.permission_delete_page'));
        }

        return parent::delete($item);
    }


    public function actions()
    {
        return [
            // CustomAction::class
        ];
    }

    public function batchActions()
    {
        return array_merge(parent::batchActions(), [
            // CustomAction::class
        ]);
    }
}
