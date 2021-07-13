<?php

namespace App;

use App\Traits\Models\SolvesTranslatableAndPaperclipConflict;
use Czim\Paperclip\Contracts\AttachableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Terranet\Translatable\Translatable;

class PageElement extends Model implements Translatable, AttachableInterface
{
    use SolvesTranslatableAndPaperclipConflict;

    protected $fillable = ['key', 'image'];

    protected $translatedAttributes = ['content'];

    public $timestamps = false;

    public function __construct(array $attributes = array())
    {
        $this->hasAttachedFile('image');

        parent::__construct($attributes);
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function getAttributes()
    {
        return parent::getAttributes();
    }
}
