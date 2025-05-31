<x-guest-layout>
    <div class="wrapper">
        <h1>Welcome</h1>

        <div class="loginregister">
            <h2 class="active">Login</h2>
            <h3><a href="{{ route('register') }}">Register</a></h3>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-field">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                <label for="email">Enter your email</label>
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600" />
            </div>

            <div class="input-field">
                <input id="password" type="password" name="password" required autocomplete="current-password" />
                <label for="password">Enter your password</label>
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600" />
            </div>

            <div class="forget">
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember" />
                    <p>Remember me</p>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                @endif
            </div>

            <button type="submit">Login</button>

            <div class="register">
                <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </div>
        </form>
    </div>
</x-guest-layout>
