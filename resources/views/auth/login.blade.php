@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label>E-mail</label>
            <input class="form-control {{ $errors->has('email') ? ' is-invalid' : ''}}" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : ''}}" name="password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember"
                value = "{{ old('remember') ? 'checked' : ''}}">
                <label class="form-check-label" for="remember">
                    Remember Me
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg mt-4">Login!</button>
    </form>
@endsection
