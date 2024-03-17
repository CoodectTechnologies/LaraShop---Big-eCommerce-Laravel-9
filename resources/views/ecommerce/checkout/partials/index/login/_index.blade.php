@guest
    <div class="login-toggle">
        {{ __('Returning customer?') }}
        <a href="{{ route('login') }}" class="show-login font-weight-bold text-uppercase text-dark">{{ __('Login') }}</a>
    </div>
    <form action="{{ route('login') }}" method="POST" class="login-content">
        @csrf
        <p>{{ __('If you have purchased from us before, please enter your details below.') }}</p>
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label>{{ __('Email') }} *</label>
                    <input type="email" class="form-control form-control-md" name="email" required>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label>{{ __('Password') }} *</label>
                    <input type="password" class="form-control form-control-md" name="password" required>
                </div>
            </div>
        </div>
        <div class="form-group checkbox">
            <input type="checkbox" class="custom-checkbox" id="remember" name="remember">
            <label for="remember" class="mb-0 lh-2">{{ __('Remember me') }}</label>
            <a href="{{ route('password.request') }}" class="ml-3">{{ __('Last your password?') }}</a>
            <a href="{{ route('register') }}" class="ml-3">{{ __('Create account?') }}</a>
        </div>
        <button type="submit" class="btn btn-rounded btn-login">{{ __('Login') }}</button>
    </form>
@endguest
