<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="{{ mix('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <title>Login</title>
</head>
<body>
    <div class="row">
        <div class="col-sm-9 col-md-4 col-lg-4 offset-sm-1 offset-md-4 offset-lg-4">
            <br><br>
            <h3 class="text-center">Sistema de Treinamento</h3>
            <br>
            <form action="{{ route('login.authenticate') }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="login">Login</label>
                        <input type="text" name="login" id="login" class="form-control @error('login') is-invalid @enderror">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('login') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error('login')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <br>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>