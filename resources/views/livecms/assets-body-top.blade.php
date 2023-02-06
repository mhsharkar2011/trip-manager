@if(auth()->check())
<div style="background-color: #ebebeb; padding: 15px 40px; text-align: right; position:sticky; top: 0; z-index: 100">
    <button id="publish_all_btn" style="display: none" class="btn btn--light">Publish all</button>
    <a style="display: inline-block;padding: 10px 20px;background-color: #000;color: #fff;text-decoration:none"
        href="{{ get_route_from_uri(request()->route()->uri) }}">
        EDIT TEMPLATE
    </a>
</div>
@endif      