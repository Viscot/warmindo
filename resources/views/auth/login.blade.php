@extends('layouts.auth-master')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Login</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input aria-describedby="emailHelpBlock" id="email" type="email"
                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                        placeholder="Registered email address" tabindex="1" value="{{ old('email') }}" autofocus>
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                    @if (App::environment('demo'))
                        <small id="emailHelpBlock" class="form-text text-muted">
                            Demo Email: admin@example.com
                        </small>
                    @endif
                </div>

                <div class="form-group">
                    <input aria-describedby="passwordHelpBlock" id="password" type="password"
                        placeholder="Your account password"
                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                        tabindex="2">
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                    @if (App::environment('demo'))
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            Demo Password: 1234
                        </small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="role">Login As</label>
                    <select id="role" name="role"
                        class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" tabindex="3">
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('role') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="4"
                            id="remember"{{ old('remember') ? ' checked' : '' }}>
                        <label class="custom-control-label" for="remember">Remember Me</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="5">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-5 text-muted text-center">
        Don't have an account? <a href="{{ route('register') }}">Create One</a>
    </div>
@endsection
