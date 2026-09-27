<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in | Wedding invitation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: linear-gradient(150deg, #d3b37d, #f4f1e9 54%, #66806b);
            color: #302f29;
            font-family: 'Kantumruy Pro', sans-serif
        }

        .auth-panel {
            width: min(440px, calc(100% - 32px));
            padding: 34px;
            background: rgba(255, 253, 247, .96);
            border: 1px solid #ffffffa8;
            box-shadow: 0 20px 55px #342b1c26
        }

        .auth-panel h1 {
            font: 28px Georgia, serif;
            margin: 0 0 7px
        }

        .auth-panel>p {
            color: #716b60;
            margin-bottom: 24px
        }

        .form-control,
        .btn {
            border-radius: 3px
        }

        .form-control {
            padding: 11px
        }

        .form-label {
            font-weight: 600
        }
    </style>
</head>

<body>
    <main class="auth-panel">
        <h1>Welcome back</h1>
        <p>Sign in to manage your wedding invitation.</p>
        @if (session('status'))<output class="alert alert-info d-block">{{ session('status') }}</output>@endif
        @if ($errors->any())<div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>@endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3"><label class="form-label" for="email">Email address</label><input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" required autofocus></div>
            <div class="mb-3"><label class="form-label" for="password">Password</label><input class="form-control" id="password" name="password" type="password" autocomplete="current-password" required></div>
            <div class="form-check mb-4"><input class="form-check-input" id="remember" name="remember" type="checkbox" value="1"><label class="form-check-label" for="remember">Remember me</label></div>
            <button class="btn btn-success w-100 py-2" type="submit">Sign in</button>
        </form>
        @if (! \App\Models\User::query()->exists())
        <p class="mt-4 mb-0 text-center">First time here? <a href="{{ route('register') }}">Create the admin account</a></p>
        @endif
        <a class="d-inline-block mt-3 text-secondary" href="{{ route('wedding.show') }}">Return to invitation</a>
    </main>
</body>

</html>