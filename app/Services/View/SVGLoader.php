<?php

namespace App\Services\View;

class SVGLoader
{
    protected static $icons;

    public function load($name)
    {
        if (!static::$icons) {
            static::$icons = $this->buildArray(
                $this->fetchIcons()
            );
        }

        return static::$icons[$name];
    }

    protected function buildArray(array $icons = [])
    {
        return array_build($icons, function ($i, $icon) {
            return [str_replace('.svg', '', basename($icon)), $this->iconContents($icon)];
        });
    }

    /**
     * @param $icon
     * @return string
     */
    protected function iconContents($icon)
    {
        return str_ireplace('<?xml version="1.0" encoding="utf-8"?>', '', file_get_contents($icon));
    }

    /**
     * @return array
     */
    protected function fetchIcons()
    {
        return glob(resource_path('assets/icons/*.svg'));
    }
}
