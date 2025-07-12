<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href={{ asset('css/vanilla.css') }}>
</head>
<body>
    <div class="login-flex-wrapper">
        <div class="login-image-bg"></div>
        <div class="login-form-side">
            <div class="login-container">
                <h2 class="login-title">Login</h2>
                @if(session('status'))
                    <div class="alert success">{{ session('status') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert error">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf
                    <div class="form-group">
                        <label for="Nama_Akun">Nama Akun</label>
                        <input id="Nama_Akun" type="text" name="Nama_Akun" value="{{ old('Nama_Akun') }}" required autofocus autocomplete="username">
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input id="Password" type="password" name="Password" required autocomplete="current-password">
                    </div>
                    <div class="form-group actions">
                        <button type="submit" class="btn-primary">Log in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            min-height: 100vh;
            background: #f7f8fa;
        }
        .login-flex-wrapper {
            display: flex;
            min-height: 100vh;
            height: 100vh;
        }
        .login-image-bg {
            flex: 1 1 0;
            background: url('/image/login-image-page.png') center center no-repeat;
            background-size: cover;
            min-width: 0;
        }
        .login-form-side {
            flex: 1 1 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            min-width: 0;
        }
        .login-container {
            width: 100%;
            max-width: 370px;
            margin: 0 auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 16px 0 rgba(37,99,235,0.08);
            padding: 2.5rem 2.2rem 2.2rem 2.2rem;
        }
        .login-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2563eb;
            margin-bottom: 2rem;
            text-align: center;
        }
        .form-group {
            margin-bottom: 1.3rem;
        }
        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #374151;
        }
        .form-group input {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 1rem;
            background: #f9fafb;
            transition: border 0.2s;
        }
        .form-group input:focus {
            border-color: #2563eb;
            outline: none;
        }
        .btn-primary {
            width: 100%;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 7px;
            padding: 0.9rem 0;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 1px 4px 0 rgba(37,99,235,0.07);
            transition: background 0.18s;
        }
        .btn-primary:hover {
            background: #1746a2;
        }
        .alert.success {
            background: #d1fae5;
            color: #15803d;
            border-radius: 7px;
            padding: 0.7rem 1rem;
            margin-bottom: 1rem;
            font-size: 1rem;
        }
        .alert.error {
            background: #fee2e2;
            color: #b91c1c;
            border-radius: 7px;
            padding: 0.7rem 1rem;
            margin-bottom: 1rem;
            font-size: 1rem;
        }
        @media (max-width: 900px) {
            .login-flex-wrapper {
                flex-direction: column;
            }
            .login-image-bg {
                min-height: 220px;
                height: 220px;
                width: 100vw;
            }
            .login-form-side {
                min-height: 400px;
                width: 100vw;
            }
        }
    </style>
</body>
</html>
