<div class="translatable-block">
    <div class="tab-content">
        @foreach(\localizer\locales() as $locale)
            <div class="tab-pane{{ $locale->id() == \localizer\locale()->id() ? ' active' : ''}}"
                 id="element_{{ $widgetKey }}_{{ $key }}_{{ $locale->id() }}" role="tabpanel">
                <div class="translatable" data-locale="{{ $locale->id() }}">
                    <?php
                    $value = null;
                    if (isset($elements[$widgetKey . '.' . $key])) {
                        if ($translation = $elements[$widgetKey . '.' . $key]->translate($locale->id())) {
                            $value = $translation->content;
                        }
                    }
                    ?>
                    @if('textarea' === $type)

                        <textarea style="min-width: 700px; height: 150px;" class="form-control"
                                  name="translatable[{{ $locale->id() }}][elements][{{ $widgetKey }}.{{ $key }}]"
                                  cols="50"
                                  rows="10">{{ $value }}</textarea>
                    @else
                        <input style="width: 100%;" class="form-control"
                               name="translatable[{{ $locale->id() }}][elements][{{ $widgetKey }}.{{ $key }}]"
                               value="{{ $value }}">
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <ul class="nav nav-tabs nav-translatable">
        @foreach(\localizer\locales() as $locale)
            <li class="{{ $locale->id() == \localizer\locale()->id() ? 'active' : ''}}">
                <a href="#element_{{ $widgetKey }}_{{ $key }}_{{ $locale->id() }}"
                   data-toggle="tab"
                   data-locale="{{ $locale->iso6391() }}"
                   aria-expanded="false"
                >
                    <strong>{{ $locale->iso6391() }}</strong>
                </a>
            </li>
        @endforeach
    </ul>
</div>
