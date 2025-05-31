<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Ranss Store Computer</title>
    <style>
        body {
            background: #f4f4f4;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            font-family: sans-serif;
        }
        .login-box {
            background: white;
            padding: 2rem;
            box-shadow: 0 0 10px #ccc;
            border-radius: 8px;
            width: 300px;
        }
        .login-box h2 {
            margin-bottom: 1rem;
        }
        input {
            width: 93.5%;
            padding: 0.5rem;
            margin-bottom: 1rem;
        }
        button {
            width: 100%;
            padding: 0.5rem;
            background: black;
            color: white;
            border: none;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Admin Login</h2>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
