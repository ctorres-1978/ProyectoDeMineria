<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Proyecto de Minería</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            background-color: #f0f0f0; /* Fondo general sutil */
        }
        .left-panel {
            flex: 1;
            background-image: url('https://i.imgur.com/W2q2o6q.png'); /* Imagen de camión minero */
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 40px;
            text-align: left;
            position: relative;
        }
        .left-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.7)); /* Oscurece la imagen para que el texto se lea mejor */
            z-index: 1;
        }
        .left-panel-content {
            position: relative;
            z-index: 2;
            max-width: 450px;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.6);
        }
        .left-panel h1 {
            font-size: 4.5vw; /* Tamaño responsivo */
            margin-bottom: 20px;
            font-weight: 300;
        }
        .left-panel p {
            font-size: 1.3vw; /* Tamaño responsivo */
            line-height: 1.6;
            margin-bottom: 30px;
            color: #e0e0e0;
        }

        .right-panel {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fdfcfb; /* Fondo derecho cálido y claro */
        }
        .login-box {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 380px;
            text-align: center;
            border: 1px solid #dcdcdc;
            transition: transform 0.3s ease-in-out;
        }
        .login-box:hover {
            transform: translateY(-5px);
        }
        .login-box h2 {
            font-size: 36px;
            color: #4a4a4a;
            margin-bottom: 25px;
            text-transform: uppercase;
            font-weight: 300;
        }
        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #6a6a6a;
            font-weight: bold;
        }
        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #fdfdfd;
        }
        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 14px;
        }
        .options a {
            color: #b07c64;
            text-decoration: none;
            transition: color 0.3s;
        }
        .options a:hover {
            color: #8c604b;
            text-decoration: underline;
        }
        .remember-me {
            display: flex;
            align-items: center;
        }
        .remember-me input {
            margin-right: 8px;
        }
        button {
            width: 100%;
            padding: 14px;
            background-color: #b07c64;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        button:hover {
            background-color: #8c604b;
            box-shadow: 0 4px 15px rgba(176, 124, 100, 0.4);
        }
    </style>
</head>
<body>
    <div class="left-panel">
        <div class="left-panel-content">
            <h1>Bienvenido de nuevo</h1>
            <p>
                Gestiona tus operaciones mineras de forma eficiente y segura.
                Accede a todas las herramientas que necesitas para optimizar
                tus procesos.
            </p>
        </div>
    </div>
    <div class="right-panel">
        <div class="login-box">
            <h2>Iniciar Sesión</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" required autofocus>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password">
                </div>
                <div class="options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember_me" name="remember">
                        <label for="remember_me">Recordarme</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">¿Olvidó su contraseña?</a>
                    @endif
                </div>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</body>
</html>