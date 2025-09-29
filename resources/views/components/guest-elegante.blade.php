<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-image: linear-gradient(135deg, #f7f3f2 0%, #e0d9d8 100%);
            background-attachment: fixed;
        }
        .container-elegante {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 400px;
            height: auto;
            margin: 20px auto;
            border: 1px solid #dcdcdc;
            transition: transform 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .container-elegante:hover {
            transform: translateY(-5px);
        }
        .header-elegante {
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .header-elegante h2 {
            font-size: 2rem;
            color: #4a4a4a;
            font-weight: 300;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="container-elegante">
        <div class="header-elegante">
            <h2>{{ __('Panel de Control') }}</h2>
        </div>
        {{ $slot }}
    </div>
</body>
</html>
