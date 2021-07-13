<tr @if(isset($item->changeRowStyleByField) && isset($item->{$item->changeRowStyleByField}) && isset($item->statusEnumColors[$item->{$item->changeRowStyleByField}]['text'])

 && !isset($item->statusEnumColors[$item->{$item->changeRowStyleByField}]['only_field'])

 ) style="color: {{ $item->statusEnumColors[$item->{$item->changeRowStyleByField}]['text'] }}; background-color: {{ $item->statusEnumColors[$item->{$item->changeRowStyleByField}]['bg'] }}" @endif>
    @if ($actions->batch()->count() && !$actions->readonly() && !($module->disableBatch ?? false))
        <th>
            <label for="collection_{{$item->getKey()}}">
                <input type="checkbox"
                       name="collection[]"
                       id="collection_{{$item->getKey()}}"
                       value="{{ $item->getKey() }}"
                       class="collection-item simple"
                >
            </label>
        </th>
    @endif
    @foreach($columns as $column)
        <td @if(isset($item->statusEnumColors[$item->{$item->changeRowStyleByField}]['only_field'])
&& in_array($column->id(),$item->statusEnumColors[$item->{$item->changeRowStyleByField}]['only_field'])) style="color: {{ $item->statusEnumColors[$item->{$item->changeRowStyleByField}]['text'] }}; background-color: {{ $item->statusEnumColors[$item->{$item->changeRowStyleByField}]['bg'] }}" @endif
        @if($column->id() == 'id') class="id-column" @endif>
            @if(!$column->isGroup())
                {!! $column->render($item) !!}
            @else
                <ul class="list-unstyled">
                    @foreach($column->elements() as $element)
                        @if($value = $element->render($item))
                            <li>
                                @if ($element->standalone())
                                    <strong>{!! $value !!}</strong>
                                @else
                                    <label for="{{ $element->id() }}">{{ $element->title() }}:</label>
                                    {!! $value !!}
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
            @endif
        </td>
    @endforeach
    @unless($actions->readonly())
        <td class="actions">
            <ul class="list-unstyled">
                @if ($actions->authorize('view', $item))
                    <li>
                        <a data-scaffold-action="{{ $module }}-view"
                           href="{{ route('scaffold.view', app('scaffold.magnet')->with(['module' => $module, 'id' => $item->getKey()])->toArray()) }}">
                            <svg width="32px" height="32px" viewBox="0 0 32 32" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="All-Reservations-Page" transform="translate(-1113.000000, -538.000000)">
                                        <g id="Block" transform="translate(240.000000, 398.000000)">
                                            <g id="Group" transform="translate(20.000000, 82.000000)">
                                                <g id="Group-3-Copy-8" transform="translate(0.000000, 44.000000)">
                                                    <g id="button/view" transform="translate(853.000000, 14.000000)">
                                                        <rect id="Rectangle-Copy-4" stroke="#259DAB" x="0.5" y="0.5"
                                                              width="31" height="31" rx="5"></rect>
                                                        <path d="M16.0101523,9.5 C18.8121827,9.5 21.3096447,11.1564516 22.9137056,12.5612903 C24.680203,14.0919355 25.7766497,15.6225806 25.7766497,15.6435484 L25.7766497,15.6435484 L26,16 L25.7766497,16.3564516 C25.7766497,16.3564516 24.7005076,17.8870968 22.9137056,19.4387097 C21.3096447,20.8435484 18.8121827,22.5 16.0101523,22.5 C10.6497462,22.5 6.28426396,16.4193548 6.22335025,16.3564516 L6.22335025,16.3564516 L6,16 L6.24365482,15.6435484 C6.28426396,15.5806452 10.6294416,9.5 16.0101523,9.5 Z M16.0101523,10.7790323 C13.5329949,10.7790323 11.2994924,12.2887097 9.85786802,13.5467742 C8.78172589,14.4903226 7.96954315,15.4548387 7.52284264,16 C8.41624365,17.1112903 9.26903553,17.95 9.85786802,18.4532258 C11.2994924,19.7112903 13.5329949,21.2209677 16.0101523,21.2209677 C18.4873096,21.2209677 20.7208122,19.7112903 22.1624365,18.4532258 C23.2385787,17.5096774 24.0507614,16.5451613 24.4974619,16 C23.6040609,14.8887097 22.751269,14.05 22.1624365,13.5467742 C20.7208122,12.2887097 18.4873096,10.7790323 16.0101523,10.7790323 Z M16.0101523,11.6596774 C18.3248731,11.6596774 20.213198,13.6096774 20.213198,16 C20.213198,18.3903226 18.3248731,20.3403226 16.0101523,20.3403226 C13.6954315,20.3403226 11.8071066,18.3903226 11.8071066,16 C11.8071066,13.6096774 13.6954315,11.6596774 16.0101523,11.6596774 Z M16.0101523,12.9177419 C14.3654822,12.9177419 13.0253807,14.3016129 13.0253807,16 C13.0253807,17.6983871 14.3654822,19.0822581 16.0101523,19.0822581 C17.6548223,19.0822581 18.9949239,17.6983871 18.9949239,16 C18.9949239,14.3016129 17.6548223,12.9177419 16.0101523,12.9177419 Z"
                                                              id="icon/view" fill="#3BA6B2" fill-rule="nonzero"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </li>
                @endif
                @if ($actions->authorize('update', $item))
                    <li>
                        <a data-scaffold-action="{{ $module }}-edit"
                           href="{{ route('scaffold.edit', app('scaffold.magnet')->with(['module' => $module, 'id' => $item->getKey()])->toArray()) }}">
                            <svg width="32px" height="32px" viewBox="0 0 32 32" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                   opacity="0.895996094">
                                    <g id="All-Reservations-Page" transform="translate(-1153.000000, -538.000000)">
                                        <g id="Block" transform="translate(240.000000, 398.000000)">
                                            <g id="Group" transform="translate(20.000000, 82.000000)">
                                                <g id="Group-3-Copy-8" transform="translate(0.000000, 44.000000)">
                                                    <g id="button/edit" transform="translate(893.000000, 14.000000)">
                                                        <rect id="Rectangle-Copy-3" stroke="#259DAB" x="0.5" y="0.5"
                                                              width="31" height="31" rx="5"></rect>
                                                        <path d="M16,8.98409091 C16.35,8.98409091 16.6045455,9.27045455 16.6045455,9.58863636 C16.6045455,9.90681818 16.35,10.1931818 16,10.1931818 L16,10.1931818 L10.8454545,10.1931818 C10.4954545,10.1931818 10.2090909,10.4795455 10.2090909,10.8295455 L10.2090909,10.8295455 L10.2090909,21.1386364 C10.2090909,21.4886364 10.4954545,21.775 10.8454545,21.775 L10.8454545,21.775 L21.1545455,21.775 C21.5045455,21.775 21.7909091,21.4886364 21.7909091,21.1386364 L21.7909091,21.1386364 L21.7909091,15.9840909 C21.7909091,15.6659091 22.0454545,15.3795455 22.3954545,15.3795455 C22.7136364,15.3795455 23,15.6340909 23,15.9840909 L23,15.9840909 L23,21.1068182 C23,22.1568182 22.1409091,22.9840909 21.1227273,22.9840909 L21.1227273,22.9840909 L10.8454545,22.9840909 C9.82727273,22.9840909 9,22.1568182 9,21.1068182 L9,21.1068182 L9,10.8295455 C9,9.81136364 9.82727273,8.98409091 10.8454545,8.98409091 L10.8454545,8.98409091 Z M19.7045455,9.82954545 L22.1227273,12.2477273 L17.0318182,17.3386364 L14.2636364,17.975 C14.1244318,18.0306818 14.0095881,17.9158381 14.0043679,17.7796786 L14.0090909,17.7204545 L14.6454545,14.9204545 L19.7045455,9.82954545 Z M22.7867231,8.24545455 L22.8863636,8.33409091 L23.65,9.09772727 C24.0636364,9.54090909 24.0931818,10.2035714 23.7386364,10.6526322 L23.65,10.7522727 L22.8227273,11.5795455 L20.4045455,9.16136364 L21.2318182,8.33409091 C21.675,7.92045455 22.3376623,7.89090909 22.7867231,8.24545455 Z"
                                                              id="icon/edit" fill="#259DAB" fill-rule="nonzero"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </li>
                @endif
                @if ($actions->authorize('delete', $item))
                    <li>
                        <a data-scaffold-action="{{ $module }}-delete" class="softDeleteItem" data-body="{{ trans('administrator::messages.confirm_deletion') }}"
{{--                           onclick="return confirm('{{ trans('administrator::messages.confirm_deletion') }}');"--}}
                           href="{{ route('scaffold.delete', app('scaffold.magnet')->with(['module' => $module, 'id' => $item->getKey()])->toArray()) }}">
                            <svg width="32px" height="32px" viewBox="0 0 32 32" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>button/delete</title>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="All-Reservations-Page" transform="translate(-1193.000000, -538.000000)">
                                        <g id="Block" transform="translate(240.000000, 398.000000)">
                                            <g id="Group" transform="translate(20.000000, 82.000000)">
                                                <g id="Group-3-Copy-8" transform="translate(0.000000, 44.000000)">
                                                    <g id="button/delete" transform="translate(933.000000, 14.000000)">
                                                        <rect id="Rectangle" stroke="#FF5252" x="0.5" y="0.5" width="31"
                                                              height="31" rx="5"></rect>
                                                        <g id="noun_Delete_1447966"
                                                           transform="translate(9.000000, 8.000000)" fill="#FF5252"
                                                           fill-rule="nonzero">
                                                            <g id="Group">
                                                                <path d="M8.2169059,0 C9.02073365,0 9.66826156,0.653521127 9.66826156,1.46478873 L9.66826156,1.46478873 L9.66826156,2.0056338 L13.4194577,2.0056338 C13.7320574,2.0056338 14,2.25352113 14,2.56901408 C14,2.88450704 13.754386,3.13239437 13.4417863,3.13239437 L13.4417863,3.13239437 L12.4816587,3.13239437 L12.4816587,14.084507 C12.4816587,15.143662 11.6331738,16 10.5837321,16 L10.5837321,16 L3.59489633,16 C2.54545455,16 1.6969697,15.143662 1.6969697,14.084507 L1.6969697,14.084507 L1.6969697,3.13239437 L0.558213716,3.13239437 C0.245614035,3.13239437 -1.86517468e-14,2.88450704 -1.86517468e-14,2.56901408 C-1.86517468e-14,2.25352113 0.245614035,2.0056338 0.558213716,2.0056338 L0.558213716,2.0056338 L4.48803828,2.0056338 L4.48803828,1.46478873 C4.48803828,0.653521127 5.13556619,0 5.93939394,0 L5.93939394,0 Z M11.3429027,3.13239437 L2.79106858,3.13239437 L2.79106858,14.084507 C2.79106858,14.5126761 3.14832536,14.8732394 3.57256778,14.8732394 L3.57256778,14.8732394 L10.5837321,14.8732394 C11.0079745,14.8732394 11.3652313,14.5126761 11.3652313,14.084507 L11.3652313,14.084507 L11.3429027,14.084507 L11.3429027,3.13239437 Z M4.68899522,4.77746479 C5.0015949,4.77746479 5.24720893,5.02535211 5.24720893,5.34084507 L5.24720893,5.34084507 L5.24720893,12.6422535 C5.24720893,12.9577465 5.0015949,13.2056338 4.68899522,13.2056338 C4.37639553,13.2056338 4.1307815,12.9577465 4.1307815,12.6422535 L4.1307815,12.6422535 L4.1307815,5.34084507 C4.1307815,5.02535211 4.37639553,4.77746479 4.68899522,4.77746479 Z M9.51196172,4.77746479 C9.8245614,4.77746479 10.0701754,5.02535211 10.0701754,5.34084507 L10.0701754,5.34084507 L10.0701754,12.6422535 C10.0701754,12.9577465 9.8245614,13.2056338 9.51196172,13.2056338 C9.22169059,13.2056338 8.95374801,12.9577465 8.95374801,12.6422535 L8.95374801,12.6422535 L8.95374801,5.34084507 C8.95374801,5.02535211 9.19936204,4.77746479 9.51196172,4.77746479 Z M7.07814992,4.77746479 C7.3907496,4.77746479 7.63636364,5.02535211 7.63636364,5.34084507 L7.63636364,5.34084507 L7.63636364,12.6422535 C7.63636364,12.9577465 7.3907496,13.2056338 7.07814992,13.2056338 C6.76555024,13.2056338 6.5199362,12.9577465 6.5199362,12.6422535 L6.5199362,12.6422535 L6.5199362,5.34084507 C6.5199362,5.02535211 6.76555024,4.77746479 7.07814992,4.77746479 Z M8.23923445,1.12676056 L5.93939394,1.12676056 C5.76076555,1.12676056 5.60446571,1.28450704 5.60446571,1.46478873 L5.60446571,1.46478873 L5.60446571,2.0056338 L8.57416268,2.0056338 L8.57416268,1.46478873 C8.57416268,1.28450704 8.41786284,1.12676056 8.23923445,1.12676056 L8.23923445,1.12676056 Z"
                                                                      id="icon/delete"></path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </li>
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
                @foreach($actions->actions()->authorized(auth('admin')->user(), $item) as $action)
                    <li>
                        {!! $action->render($item) !!}
                    </li>
                @endforeach
            </ul>
        </td>
    @endunless
</tr>
