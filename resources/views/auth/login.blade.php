@extends('admin/layouts/admin_login') 
@section('content')
<form class="form-signin" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <h1>4Xtreme Admin</h1>
    <h1 id="txt_login_pls" class="h3 mb-3 font-weight-normal">Jelentkezzen be</h1>
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" value="{{ old('email') }}" placeholder="Email cím" required autofocus>        
        @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span> 
        @endif
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="inputPassword" class="sr-only">Jelszó</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Jelszó" required>
        @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>
    {{-- <div class="form-check">
        <input class="form-check-input" id="login_remember" type="checkbox" name="remember" {{ old( 'remember') ? 'checked' : ''
            }}>
        <label class="form-check-label" for="login_remember">Emlékezzen rám</label>
    </div> --}}
    <button id="login_btn" class="btn btn-lg btn-primary btn-block" type="submit">Bejelentkezés</button>
    <a class="btn btn-link" href="{{ route('password.request') }}" target="_blank">Elfelejtette a jelszavát?</a>
</form>
@endsection
@push('styles')
<!-- Dinamikus stílus fájlok ide: -->
<!-- Custom CSS -->
<link href="/adminset/css/custom/login.css" rel="stylesheet" /> 
@endpush 
@push('scripts')
<!-- Dinamikus script fájlok ide: -->

@endpush