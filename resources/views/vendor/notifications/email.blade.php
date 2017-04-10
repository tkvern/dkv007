@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# 警告!
@else
# 您好!
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@if (isset($actionText))
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endif

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

<!-- Salutation -->
@if (! empty($salutation))
{{ $salutation }}
@else

此致

量子云团队支持
@endif

<!-- Subcopy -->
@if (isset($actionText))
@component('mail::subcopy')
如果你无法点击 "{{ $actionText }}" 按钮, 复制粘贴下面的地址在浏览器中打开: [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endif
@endcomponent
