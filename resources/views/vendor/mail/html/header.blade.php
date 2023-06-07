@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="<?php env('APP_URL') . '/images/aeemm_logo.jpg'?>" class="logo" alt="AEEMM Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
