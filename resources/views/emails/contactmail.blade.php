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
    <h1>Kedves Kolléga!</h1>
    <h3>Önnek új üzenete érkezett!</h3>
    </div>
    @endcomponent

    @component('mail::table')
    <table>
        <tr>
            <td><b>Név:</b></td>
            <td>{{ $mail_datas_array['username'] }}</td>
        </tr>
        <tr>
            <td><b>Feladó email címe:</b></td>
            <td>{{ $mail_datas_array['email'] }}</td>
        </tr>
        <tr>
            <td><b>Telefonszám:</b></td>
            <td>{{ $mail_datas_array['phone'] }}</td>
        </tr>
        <tr>
            <td><b>Üzenet:</b></td>
            <td>{{ $mail_datas_array['message'] }}</td>
        </tr>
    </table>
    @endcomponent
    @endslot

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <!-- footer here -->
        @endcomponent
    @endslot
@endcomponent