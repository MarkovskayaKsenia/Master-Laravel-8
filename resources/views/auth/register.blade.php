@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : ''}}" name="name" value="{{ old('name') }}" required>

            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
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
            <label>Retyped Password</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary btn-lg mt-4">Register!</button>
    </form>
@endsection
