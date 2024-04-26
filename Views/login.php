<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.2.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link href="style.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div class="background"></div>
    <div class="container">
        <div class="form-container">
            <div class="left">
                <div class="logo-name">Contact App Manager</div>
                <img class ="logo" src="./assets/logo.png" alt="">
                <p class="logo-desc">Sistem Pengelolaan Kontak dengan Mudah dan Efisien</p>
                
            </div>
            <div class="right">
                <div class="title">Login</div>
                <input class="input" type="text" placeholder="username" required>
                <div class="password-wrapper">
                    <input class="input" type="password" placeholder="password" required>
                    <i class="toggle-password fi fi-rr-eye"></i>
                </div>
                <div class="text-wrapper">
                    <div><a href="register.html">Belum punya akun?</a></div>
                    <div><p>Lupa Password?</p></div>
                </div>
                <button class="btn-login" type="submit"><a href="dashboard.html">Login</a></button>
            </div>
        </div>
    </div>
</body>

</html>