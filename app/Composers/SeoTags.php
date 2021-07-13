<?php

namespace App\Composers;

use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\View\View;

class SeoTags
{
    use HandlesSeoPages;
    protected $locale;
    /**
     * @var Router
     */
    private $router;
    /**
     * @var Route
     */
    protected $route;

    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->route = $router->current();
        $this->locale = \localizer\locale();
    }

    public function compose(View $view)
    {
        if (!$route = $this->route) {
            $this->notFoundMeta();

            return;
        }

        switch ($route->getName()) {
            case 'page.show':
                $this->routeMeta(\request('type'));
                break;
            default:
                $this->routeMeta($route->getName());
        }
    }

    protected function currentUrl()
    {
        return \URL::current();
    }
}
