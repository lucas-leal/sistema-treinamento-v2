<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <script src="{{ mix('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <form action="/users" method="post">
        @csrf
        <h3>Register user</h3>
        <div class="form-row col-md-8">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                <div class="invalid-feedback">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                <div class="invalid-feedback">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-row col-md-8">
            <div class="form-group col-md-6">
                <label for="login">Login</label>
                <input type="text" name="login" id="login" value="{{ old('login') }}" class="form-control @error('login') is-invalid @enderror">
                <div class="invalid-feedback">
                    @error('login')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                <div class="invalid-feedback">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</body>
</html>