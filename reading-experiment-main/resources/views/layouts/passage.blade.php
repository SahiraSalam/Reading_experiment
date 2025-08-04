<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>

        @yield('title')
    </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 80px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 900px;
            text-align: center;
        }

        .button-container {
            display: flex;
            justify-content: flex-end; /* Aligns button to the right */
            margin-top: 5px;
        }

        .button {
            background-color: #007bff;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 150px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        @stack('style')
    </style>


</head>
<body>
<div class="container">
    @yield('body')
</div>
</body>
</html>
