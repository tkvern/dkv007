@component('mail::message')
# 用户激活
点击激活按钮激活用户

@component('mail::button', ['url' => route('user.activate', ['token' => 'token'])])
激活用户
@endcomponent

谢谢,
{{ config('app.name') }}
@endcomponent