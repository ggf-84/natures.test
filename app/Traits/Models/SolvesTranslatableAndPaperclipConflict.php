<?php

/**
 * Resolve conflict between EloquentTrait, HasTranslations for get/setAttribute methods
 *
 * @var [type]
 */

namespace App\Traits\Models;

use Czim\Paperclip\Model\PaperclipTrait;
use Terranet\Translatable\HasTranslations;

trait SolvesTranslatableAndPaperclipConflict
{
    use PaperclipTrait, HasTranslations {
        HasTranslations::getAttribute as getTranslatedAttribute;
        HasTranslations::setAttribute as setTranslatedAttribute;
        PaperclipTrait::getAttribute as getPaperAttribute;
        PaperclipTrait::setAttribute as setPaperAttribute;
    }

    public function getAttribute($key)
    {
        if ($this->isKeyReturningTranslationText($key)) {
            return $this->getTranslatedAttribute($key);
        }

        if (array_key_exists($key, $this->attachedFiles)) {
            return $this->getPaperAttribute($key);
        }

        return parent::getAttribute($key);
    }

    public function setAttribute($key, $value)
    {
        if ($this->hasTranslatedAttributes() && in_array($key, $this->translatedAttributes)) {
            return $this->setTranslatedAttribute($key, $value);
        }

        if (array_key_exists($key, $this->attachedFiles)) {
            return $this->setPaperAttribute($key, $value);
        }

        return parent::setAttribute($key, $value);
    }
}
