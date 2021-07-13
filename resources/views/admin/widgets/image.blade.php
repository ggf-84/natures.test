@if(isset($elements[$key]) && $elements[$key]->image->originalFilename())
    <div>
        <div style="display:inline-block; margin-right: 5px; border: 1px solid gray;">
            <a href="{{ $elements[$key]->image->url() }}" class="fancybox" style="display: inline-block; text-align: center;">
                <img src="{{ $elements[$key]->image->url() }}" style="width: 75px; height: 75px;">
            </a>
        </div>
    </div>
    <div style="margin-top: 10px;">
        <a href="{{ route('scaffold.delete_attachment', ['pages', $elements[$key]->page_id, $elements[$key]->id]) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger" style="padding: 2px 46px;">
            Delete file
        </a>
    </div>
@else
    <input name="images[{{ $key }}]" type="file" id="element_{{ $key }}">
@endif

