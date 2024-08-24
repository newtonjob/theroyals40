<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
    <img src="{{ tenant()->logo }}" class="logo" style="border-radius: 7px" alt="Logo">
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} [<img src="/favicon.png" width="15"> Plain Invite](https://plaininvite.com). @lang('All rights reserved.')
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
