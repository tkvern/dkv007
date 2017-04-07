@component('mail::message')

{{ $user_name }}，您好！

欢迎使用量子云！

您现在需要点击激活按钮激活用户，从而可以正式使用量子云。

@component('mail::button', ['url' => route('user.activate', ['token' => $token])])
激活用户
@endcomponent

此致

量子云团队支持


@endcomponent
