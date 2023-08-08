{{--<h1>{{ $title }}</h1>--}}
{{--<div>--}}
{{--    {{ $content }}--}}
{{--</div>--}}
@component('mail::message')
# {{ $title }}

{{ $content }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
