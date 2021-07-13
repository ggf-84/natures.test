<?php

namespace App\Http\Controllers\Admin;

use App\Services\Translations;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Translation\Translator;
use Terranet\Administrator\Controllers\AdminController;

class TranslationsController extends AdminController
{
    private $service;

    private $perPage = 20;

    public function __construct(Translations $service, Translator $translator)
    {
        $this->service = $service;

        parent::__construct($translator);
    }

    public function index(Request $request)
    {
        ini_set('opcache.enable', 0);

        $translations = $this->service->load(
            $request->get('search', null),
            $request->get('filter', null)
        );

        $page = $request->get('page');
        $totalTranslations = count($translations);
        $translations = $this->service->paginate($translations, $this->perPage, $page);

        $pagination = new LengthAwarePaginator(
            $translations,
            $totalTranslations,
            $this->perPage,
            $request->get('page', 1),
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );

        $paginationView = $pagination->appends(['search' => $request->input('search'), 'filter' => $request->filter])->links();
        $scopes = $this->service->scopes();

        return view('admin.translations.index', compact('translations', 'totalTranslations', 'paginationView', 'scopes'));
    }

    public function store(Request $request)
    {
        ini_set('opcache.enable', 0);

        $redirectTo = redirect()->back()->with('messages', [trans('administrator::messages.update_success')]);

        if (empty($translation = $request->input('translation'))) {
            return $redirectTo;
        }

        foreach (\localizer\locales() as $locale) {
            $this->service->save($translation, $locale->iso6391());
        }

        return $redirectTo;
    }
}
