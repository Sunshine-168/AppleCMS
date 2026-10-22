@php
    $capId = $capId ?? 'capWidget';
    $capEndpoint = \App\Support\Captcha::widgetEndpoint();
@endphp
@if($capEndpoint !== '')
    <script src="https://cdn.jsdelivr.net/npm/@cap.js/widget"></script>
    <cap-widget id="{{ $capId }}" data-cap-api-endpoint="{{ $capEndpoint }}"></cap-widget>
@endif
