@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => 'javascript:'])
            <!-- header here -->
            {{ $mail_datas_array['subject'] }}
        @endcomponent
    @endslot

    {{-- Body --}}
    @slot('subcopy')
    @component('mail::panel')
    <div>
    <h1>Kedves Ügyfelünk!</h1>
    <div>
    {!! trim($mail_datas_array['message']) !!}
    </div>
    </div>
    @endcomponent
    @endslot

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <p>Üdvözlettel.,</p>
            <p>4Xtreme Kft.</p>
            <p>Gumi és Autószerviz</p>
        @endcomponent
    @endslot
@endcomponent