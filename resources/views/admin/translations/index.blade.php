@inject('config', 'scaffold.config')
@inject('template', 'scaffold.template')

@extends($template->layout())

@section('scaffold.content')
    <h4>
        {{ trans('administrator::module.resources.translations') }}
        <sup class="small">({{ $totalTranslations }})</sup>
    </h4>

    <div class="panel">
        <ul class="panel-options">
            <li><a class="panel-minimize"><i class="fa fa-chevron-down"></i></a></li>
        </ul>
        <div class="panel-heading">
            <h4 class="panel-title panel-minimize">Filters</h4>
        </div>
        <div class="panel-body" style="display: {{ request('search') ? 'block' : 'none' }}">
            <form action="" data-id="filter-form" class="form">
                <div class="scaffold-filters">
                    <div class="inputs">
                        <div class="form-group">
                            <label for="company_id">
                                Search
                                <input name="search" type="search" class="form-control" value="{{ app('request')->input('search') }}">
                            </label>
                        </div>
                    </div>
                    <div class="buttons">
                        <button type="submit" class="btn btn-primary btn-block btn-quirk">
                            <i class="fa fa-search"></i>
                            {{ trans('administrator::buttons.search') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 people-list">
            <div class="batch-options nomargin">
                @foreach($scopes->prepend('all') as $filter)
                    <a class="btn btn-link {{ app('request')->input('filter') === $filter ? 'active' : '' }}"
                       href="{{ route('translations.index', ['filter' => $filter, 'search' => request('search')], false) }}">
                        {{ title_case($filter) }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-body">
            <form action="" method="post">
                {!! csrf_field() !!}
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th width="20%" style="vertical-align: middle">Key</th>
                        <th style="vertical-align: middle">Translation</th>
                        <th width="20%">
                            <div class="btn-group global" style="padding-left: 0;">
                                @foreach($locales = \localizer\locales() as $loc)
                                    <button type="button"
                                            class="btn btn-default btn-sm {{ ($loc->isDefault() ? 'active' : '') }}"
                                            data-locale="{{$loc->iso6391()}}"
                                    >
                                        {{$loc->iso6391()}}
                                    </button>
                                @endforeach
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($translations as $key => $value)
                        <tr>
                            <td>
                                <?php
                                $title = $key;
                                if ($filter = request()->get('filter')) {
                                    $title = preg_replace('~^' . $filter . 's?\.~', '', $title);
                                }
                                $parts = array_map(function ($part) {
                                    return title_case(str_replace(['_', '-'], ' ', $part));
                                }, explode('.', $title));
                                ?>
                                <span class="bold">{!! ucwords(implode(' &raquo; ', $parts)) !!}</span>
                            </td>
                            <td>
                                <div class="translatable-item pull-left" style="width:100%">
                                    @foreach($locales as $locale)
                                        <div class="translatable {{ $locale->isDefault() ? '' : 'hidden'}}"
                                             style="width:100%"
                                             data-locale="{{$locale->iso6391()}}">
                                            <textarea
                                                class="form-control" style="width:100%"
                                                name="translation[{{ $key }}][{{ $locale->iso6391() }}]" cols="50"
                                                rows="2">{{ $value[$locale->iso6391()] ?? '' }}
                                            </textarea>
                                        </div>
                                    @endforeach()
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    @foreach($locales as $locale)
                                        <button
                                            type="button"
                                            class="btn btn-default btn-sm {{ ($locale->isDefault() ? 'active' : '') }}"
                                            data-locale="{{ $locale->iso6391() }}"
                                        >
                                            {{ $locale->iso6391() }}
                                        </button>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    @if($totalTranslations)
                        <tfoot>
                        <tr>
                            <th></th>
                            <th>
                                <button type="reset" class="btn btn-default pull-right">
                                    {{ trans('administrator::buttons.reset') }}
                                </button>
                            </th>
                            <th>
                                <button style="margin-right: 15px;" class="btn btn-block btn-primary">
                                    {{ trans('administrator::buttons.save') }}
                                </button>
                            </th>
                        </tr>
                        </tfoot>
                    @endif
                </table>
            </form>

            <div class="pull-right">
                {!! $paginationView !!}
            </div>
        </div>
    </div>
@endsection

@section('scaffold.js')
    <script>
        $(function() {
            $('.global button[data-locale]').click(function() {
                var fn = $(this), locale = fn.data('locale');

                fn.siblings('button').removeClass('active');
                fn.addClass('active');

                $(fn).closest('table').find('tbody button[data-locale="' + locale + '"]').each(function(i, button) {
                    $(button).trigger('click');
                });
            });

            $('tbody button[data-locale]').click(function() {
                var fn = $(this), locale = fn.data('locale');

                fn.siblings('button').removeClass('active');
                fn.addClass('active');

                fn.closest('tr').find('.translatable').each(function() {
                    var item = $(this);

                    if (item.data('locale') === locale) {
                        item.removeClass('hidden');
                    } else {
                        item.addClass('hidden');
                    }
                });
            });
        });
    </script>
@append
