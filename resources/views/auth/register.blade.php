<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('styliss.css') }}" />
</head>
<body>
    <div class="wrapper">
        <h1>Create Account</h1>
        <div class="loginregister">
            <h3><a href="{{ route('loginUser') }}">Login</a></h3>
            <h2>Register</h2>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-field">
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus />
                <label for="name">Enter your name</label>
                @error('name')
                    <p style="color: red; font-size: 0.8rem;">{{ $message }}</p>
                @enderror
            </div>

            


            <div class="input-field">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required />
                <label for="email">Enter your email</label>
                @error('email')
                    <p style="color: red; font-size: 0.8rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-field">
                <input id="password" type="password" name="password" required autocomplete="new-password" />
                <label for="password">Enter your password</label>
                @error('password')
                    <p style="color: red; font-size: 0.8rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-field">
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                <label for="password_confirmation">Confirm your password</label>
            </div>

            <div class="forget">
                <label for="remember">
                    <input id="remember" type="checkbox" name="remember" />
                    <p>Remember me</p>
                </label>
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

            <button type="submit">Register</button>

            <div class="register">
                <p>Already have an account? <a href="{{ route('loginUser') }}">Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>
