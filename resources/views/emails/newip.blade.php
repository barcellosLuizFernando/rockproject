@component('mail::message')
# Comunicado de novo IP Externo

Olá.<br>
Acabamos de detectar que seu IP Externo mudou para {{ $config->key }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
