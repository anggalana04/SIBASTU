<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href={{ asset('css/vanilla.css') }}>
</head>
<body>
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
</body>
</html>
