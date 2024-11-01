<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Coupon System </title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .welcome {
            margin-top: 50px;
            font-size: 2rem;
            color: #4a5568;
        }

        .description {
            margin-top: 20px;
            font-size: 1.125rem;
            color: #718096;
        }

        .coupon-button {
            margin-top: 30px;
            padding: 10px 20px;
            font-size: 1rem;
            color: white;
            background-color: #3182ce;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .coupon-button:hover {
            background-color: #2b6cb0;
        }
    </style>
</head>

<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen">
        <div class="container">
            <div class="welcome">Welcome to Our Store!</div>
            <div class="description">Explore our wide range of products and enjoy great deals.</div>
            <a href="/cart">
                <button class="coupon-button">Create Coupon</button>
            </a>
        </div>
    </div>
</body>

</html>