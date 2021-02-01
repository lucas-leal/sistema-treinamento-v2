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
        <div class="col-sm-4 offset-md-4">
            <h3>Login</h3>
            <form action="login" method="post">
                @csrf
                <input type="text" name="login" id="" class="form-control" placeholder="Login">
                <br>
                <input type="password" name="password" id="" class="form-control" placeholder="Password">
                <br>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</body>
</html>