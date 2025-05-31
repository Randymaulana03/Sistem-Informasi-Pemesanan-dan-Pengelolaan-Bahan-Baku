<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Ranss Store Computer</title>
    <link rel="stylesheet" href="{{ asset('styliss.css') }}" />
</head>
<body>
    <div class="wrapper">
        <h1>Welcome</h1>
        <div class="loginregister">
            <h2>Login</h2>
            <h3><a href="{{ route('register') }}">Register</a></h3>
        </div>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 1rem;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('loginUser') }}">
            @csrf

            <div class="input-field">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                <label for="email">Enter your email</label>
            </div>

            <div class="input-field">
                <input id="password" type="password" name="password" required autocomplete="current-password" />
                <label for="password">Enter your password</label>
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
             <script>
                document.querySelectorAll('.input-field input').forEach(input => {
                    // cek saat halaman load
                    if(input.value.trim() !== '') {
                        input.parentElement.classList.add('filled');
                    }
                    // cek saat user ketik / ubah input
                    input.addEventListener('input', () => {
                        if(input.value.trim() !== '') {
                            input.parentElement.classList.add('filled');
                        } else {
                            input.parentElement.classList.remove('filled');
                        }
                    });
                });
            </script>

            <button type="submit">Login</button>

            <div class="register">
                <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>
