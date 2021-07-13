@unless($actions->readonly() || (isset($module->disableActionRows['top']) && $module->disableActionRows['top']))
    @if (isset($item))
        <div class="btn-group pull-right mt5">
            @if ($actions->authorize('view', $item))
                <a href="{{ route('scaffold.view', ['module' => $module, 'id' => $item->getKey()]) }}"
                   class="btn btn-primary btn-quirk">
                    <i class="fa fa-eye"></i>
                    {{ trans('administrator::buttons.view') }}
                </a>
            @endif
            @if ($actions->authorize('create'))
                <a href="{{ route('scaffold.create', ['module' => $module]) }}"
                   class="btn btn-success btn-quirk">
                    <i class="fa fa-plus"></i>
                    {{ trans('administrator::buttons.create') }}
                </a>
            @endif

            @if ($actions->authorize('delete', $item))
                <a href="{{ route('scaffold.delete', ['module' => $module, 'id' => $item->getKey()]) }}"
                   class="btn btn-danger btn-quirk softDeleteItem"
                   data-body="{{ trans('administrator::messages.confirm_deletion') }}"
{{--                   onclick="return confirm('Are you sure?');"--}}
                >
                    <i class="fa fa-trash"></i>
                    {{ trans('administrator::buttons.delete') }}
                </a>
                    @push('scaffold.js')
                        <script>
                            CustomConfirm('.softDeleteItem', function (confirmed, element) {
                                if (confirmed) {
                                    location.href = element.href;
                                }
                            });

                            $('.softDeleteItem').click(function (){
                                var text = $(this).data('body');
                                $('.c2_body').html(text);
                            })
                        </script>
                    @endpush
            @endif
        </div>
    @endif
@endunless
