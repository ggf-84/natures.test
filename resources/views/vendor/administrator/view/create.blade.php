@unless($actions->readonly())
    <div class="btn-group pull-right mt5">
        @if ($actions->authorize('update', $item))
            <a href="{{ route('scaffold.edit', ['module' => $module, 'id' => $item->getKey()]) }}"
               class="btn btn-info btn-quirk">
                <i class="fa fa-pencil"></i>
                {{ trans('administrator::buttons.edit') }}
            </a>
        @endif
        @if ($actions->authorize('delete', $item))
            <a href="{{ route('scaffold.delete', ['module' => $module, 'id' => $item->getKey()]) }}"
               class="btn btn-danger btn-quirk softDeleteItem"
               data-body="{{ trans('administrator::messages.confirm_deletion') }}"
{{--               onclick="return confirm('Are you sure?');"--}}
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
@endunless
