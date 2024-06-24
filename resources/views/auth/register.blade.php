@extends('layouts.auth-master')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Register</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                        name="name" value="{{ old('name') }}" required autofocus>
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email"
                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                        value="{{ old('email') }}" required>
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password"
                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-5 text-muted text-center">
        Already have an account? <a href="{{ route('login') }}">Login</a>
    </div>

    <script></script>
@endsection
