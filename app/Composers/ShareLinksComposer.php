<?php

namespace App\Composers;

use Illuminate\View\View;

class ShareLinksComposer
{
    /**
     * @param  View  $view
     */
    public function compose(View $view)
    {
        $url = url()->full();

        $view->share = (object) [
            'twitter' => 'https://twitter.com/intent/tweet?'.http_build_query([
                    'hashtags' => config('app.name'),
                    'original_referer' => $url,
                    'text' => trans('general.plant_a_tree'),
                    'url' => $url,
                ]),

            'facebook' => 'https://www.facebook.com/sharer/sharer.php?'.http_build_query([
                    'u' => $url,
                ]),
        ];
    }
}
