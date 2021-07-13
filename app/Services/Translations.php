<?php

namespace App\Services;

use File;
use Zend\Code\Generator\ValueGenerator;

class Translations
{
    protected $filters;

    public function __construct()
    {
        $this->filters = config('translations.files');
    }

    public function load($search, $filter)
    {
        $translations = $this->loadFromFiles($this->filters);

        if ($search) {
            $translations = $this->searchByKey($translations, $search);
        }

        if ($filter && in_array($filter, $this->filters)) {
            $translations = $this->filter($translations, $filter);
        }

        return $translations;
    }

    public function save($translation, $locale)
    {
        $translations = [];

        foreach ($translation as $key => $value) {
            $this->keyToArray($translations, $key, $value[$locale]);
        }
        foreach ($translations as $key => $value) {
            if (!$translations = $this->loadTranslationFile($key, $locale)) {
                continue;
            }

            $data = array_replace_recursive($translations['translatedData'], $value);

            $content = '<?php' . str_repeat(PHP_EOL, 2) . 'return ' . $this->arrayAsString($data) . ';';

            File::put($translations['filePath'], $content, true);
        }
    }

    protected function filter($translations, $filter)
    {
        $keys = [];
        foreach ($translations as $key => $translation) {
            if (starts_with(strtolower($key), strtolower($filter))) {
                $keys[$key] = $translation;
            }
        }

        return $keys;
    }

    protected function searchByKey($translations, $keyword)
    {
        $keys = [];
        foreach ($translations as $key => $translation) {
            foreach ($translation as $lang => $value) {
                if (str_contains(strtoupper($value), strtoupper($keyword))
                    || str_contains(strtoupper($key), strtoupper($keyword))) {
                    $keys[$key] = $translation;
                    continue;
                }
            }
        }

        return $keys;
    }

    public function loadFromFiles(array $files = [])
    {
        $translations = [];

        foreach (\localizer\locales() as $locale) {
            foreach ($files as $file) {
                if (file_exists($filePath = resource_path('lang' . DIRECTORY_SEPARATOR . $locale->iso6391() . DIRECTORY_SEPARATOR . $file . '.php'))) {
                    $translatedData[$file] = include_once $filePath;

                    foreach (array_dot($translatedData) as $key => $value) {
                        $translations[$key][$locale->iso6391()] = $value ? $value : '';
                    }
                }
            }
        }

        return $translations;
    }

    protected function loadTranslationFile($file, $locale)
    {
        if (!file_exists($filePath = resource_path('lang' . DIRECTORY_SEPARATOR . $locale . DIRECTORY_SEPARATOR . $file . '.php'))) {
            $this->makeFile($file, $locale);
        }

        $translatedData = include_once $filePath;

        return [
            'filePath' => $filePath,
            'translatedData' => $translatedData,
        ];
    }

    protected function makeFile($file, $locale)
    {
        $directoryTranslationsPath = resource_path('lang' . DIRECTORY_SEPARATOR . $locale);

        if (!File::exists($directoryTranslationsPath)) {
            File::makeDirectory($directoryTranslationsPath);
        }

        $content = '<?php' . str_repeat(PHP_EOL, 2) . 'return array();';

        File::put($directoryTranslationsPath . DIRECTORY_SEPARATOR . $file . '.php', $content, true);
    }

    public function paginate($translations, $perPage, $page)
    {
        if (!$count = count($translations)) {
            return [];
        }

        $pages = array_chunk($translations, $perPage, true);

        $min = 1;
        $max = ceil($count / $perPage);

        if ($page < $min || $page > $max) {
            $page = 1;
        }

        return $pages[$page - 1];
    }

    protected function keyToArray(&$arr, $path, $value, $separator = '.')
    {
        foreach ($keys = explode($separator, $path) as $key) {
            $arr = &$arr[$key];
        }
        $arr = $value;
    }

    /**
     * @param $data
     * @return string
     */
    protected function arrayAsString($data): string
    {
        $generator = new ValueGenerator($data, ValueGenerator::TYPE_ARRAY_SHORT);
        $generator->setIndentation('    '); // 4 spaces

        return $generator->generate();
    }

    public function scopes()
    {
        return collect($this->filters);
    }

    public function exportToJs()
    {
        if ($translations = $this->loadAllTranslationsFiles()) {
            $translations = $this->replaceDynamicAttributes($translations);

            $jsDirectoryTranslationsPath = public_path('js' . DIRECTORY_SEPARATOR . 'translations');

            if (!File::exists($jsDirectoryTranslationsPath)) {
                File::makeDirectory($jsDirectoryTranslationsPath);
            }

            foreach ($translations as $lang => $translation) {
                $content = 'window.messages = {"' . $lang . '":' . \GuzzleHttp\json_encode($translation) . '};';
                file_put_contents($file = $jsDirectoryTranslationsPath . DIRECTORY_SEPARATOR . $lang . '.js', $content);
            }
        }
    }

    private function loadAllTranslationsFiles()
    {
        $translations = [];
        $directoryPath = resource_path('lang' . DIRECTORY_SEPARATOR);
        foreach (\localizer\locales() as $locale) {
            if (!File::exists($directoryPath . $locale->iso6391())) {
                continue;
            }

            if ($files = File::files($directoryPath . $locale->iso6391())) {
                foreach ($files as $file) {
                    $fileName = str_replace('.php', '', $file->getFilename());
                    $translations[$locale->iso6391()][$fileName] = trans($fileName, [], $locale->iso6391());
                }
            }
        }

        return $translations;
    }

    private function replaceDynamicAttributes($translations)
    {
        foreach ($translations as &$translation) {
            if (is_array($translation)) {
                $translation = $this->replaceDynamicAttributes($translation);
                continue;
            }

            $translation = preg_replace('%:([a-z\_]+)%m', '{$1}', $translation);
        }

        return $translations;
    }
}
