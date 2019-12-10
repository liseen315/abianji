@component('mail::message')
# {{ $user }} 给您留言了.
{!! $markdown !!}

@component('mail::button', ['url' => $articleURL])
点击查看
@endcomponent


谢谢关注 <strong>{{ config('app.name') }}</strong>
@endcomponent
