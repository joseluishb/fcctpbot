@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Servicios de Matrícula 2024-2' || trim($slot) === 'Servicios de Matricula 2024-2')
<img src="{{ asset('assets/images/header-msge.jpg') }}" class="img-fluid" style="width: 100%; max-width: 100%; height: auto;">

@else
{{ $slot }}
@endif
</a>
</td>
</tr>
