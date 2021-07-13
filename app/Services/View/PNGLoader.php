<?php

namespace App\Services\View;

class PNGLoader
{
    protected $image;

    protected $path;

    public function __construct($image, $path)
    {
        $this->image = $image;
        $this->path = $path;
    }

    public function load()
    {
        if ($this->fileExist() && $this->checkExtension()) {
            return $this->image;
        }

        return '';
    }

    protected function fileExist()
    {
        if ('public' === $this->path) {
            return file_exists(
                public_path($this->image)
            );
        }

        return file_exists(
            resource_path($this->image)
        );
    }

    protected function checkExtension()
    {
        $extension = pathinfo($this->image, PATHINFO_EXTENSION);

        return $extension === 'png';
    }
}
