@extends('admin/layouts/admin_login') 
@section('content')
<form class="form-signin" method="POST" action="{{ route('password.email') }}">
    @csrf
    <h1>4Xtreme Admin</h1>
    <h1 id="txt_login_pls" class="h3 mb-3 font-weight-normal">Jelszó helyreállítása</h1>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email">Kérjük adja meg a regisztrációkor megadott e-mail címét!</label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email cím" required>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <button id="login_btn" type="submit" class="btn btn-lg btn-primary btn-block">Jelszó visszaállítás</button>
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
