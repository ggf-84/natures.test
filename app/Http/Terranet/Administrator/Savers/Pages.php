<?php

namespace App\Http\Terranet\Administrator\Savers;

use App\Page;
use App\PageElement;
use App\PageElementTranslation;
use Terranet\Administrator\Services\Saver;

class Pages extends Saver
{
    protected $postElements;

    public function save()
    {
        $this->setElements();

        parent::save();
    }

    public function saveRelations()
    {
        parent::saveRelations();

        $this->syncElements();
    }

    private function syncElements()
    {
        if (!$this->postElements) {
            return false;
        }

        $partials = $this->repository->elements();

        foreach ($this->postElements as $key => $inputs) {
            $element = $partials->get($key, new PageElement());

            $element->page_id = $this->repository->id;
            $element->key = $key;
            $element->image = null;

            $element->fill($inputs)->save();
        }
    }

    private function setElements()
    {
        //set type static page
        if (!$this->repository->id) {
            $this->data['type'] = Page::TYPE_PAGE;
        }

        if ($this->request->file('images')) {
            foreach ($this->request->file('images') as $key => $image) {
                $this->postElements[$key] = ['image' => $image];
            }
        }

        $emptyTranslations = [];

        foreach (\localizer\locales() as $locale) {
            if (isset($this->data[$locale->id()]['elements'])) {
                foreach ($this->data[$locale->id()]['elements'] as $key => $value) {
                    if (!empty($value)) {
                        $this->postElements[$key][$locale->id()]['content'] = $value;
                    }
                }
                unset($this->data[$locale->id()]['elements']);
            }
        }

        $this->cleanEmptyTranslations();
    }

    private function cleanEmptyTranslations(): void
    {
        (new PageElementTranslation)->whereNull('content')->delete();
    }
}
