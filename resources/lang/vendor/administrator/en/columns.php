<?php

/*
|--------------------------------------------------------------------------
| Columns translations.
|--------------------------------------------------------------------------
|
| This file serves as a main translation place for all your columns.
| Instead of defining FormElement::update() method, just add your
| column here. Columns having global name can be defined also.
*/

return [

    'global' => [
        'meta' => 'Page Meta',
        'meta_title' => 'Title',
        'meta_description' => 'Description',
        'meta_keywords' => 'Keywords',
        'meta_max_symbols' => 'Max 255 symbols',
    ],

    'pages' => [
        'description' => 'Content',
        'no_files_note' => '"No CV uploaded" note',
        'types' => [
            'page' => 'Page',
            'widget' => 'Widget',
        ],
        'target' => 'Open in new tab',
        'url' => 'Embed URL',
    ],

    'sections' => [
        'general_details' => 'General Details',
        'meta' => 'Meta',
    ],
];
